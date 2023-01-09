<?php
/**
 * @package IrisnetAPIClient
 */

use \GuzzleHttp\Client;
use Inc\Helper\RulesHelper;
use \GuzzleHttp\Cookie\CookieJar;
use \Irisnet\APIV1\Client\ApiException;
use \Irisnet\APIV1\Client\Model\IrisNet;
use \Irisnet\APIV1\Client\Model\INParam;
use \Irisnet\APIV1\Client\Model\INParams;
use \Irisnet\APIV1\Client\Model\INDefault;
use \Irisnet\APIV1\Client\Api\EndpointsToSetupTheAIApi;
use \Irisnet\APIV1\Client\Api\EndpointsForAIChecksApi;
use \Irisnet\APIV1\Client\Api\MiscellaneousOperationsApi;

/**
 * Helper class to connect to the irisnet API.
 */
class IrisnetAPIConnector
{

    private static $cookieJar;

    /**
     * Sets the rule set for the upcoming checks.
     *
     * @param string $rule the given name of the rule set.
     * @throws IrisnetException is thrown in case that the rule name could not be found or if the API request fails (will contain the status code and the message returned from the failed API request).
     * @return boolean TRUE if the rule set is successfully applied.
     */
    public static function setRules(string $rule) : bool
    {
        $parameters = self::createParameterModel($rule);

        try {
            $apiInstance = new EndpointsToSetupTheAIApi(
                new Client(self::getClientConfig(true, true))
            );

            $apiInstance->setINParams($parameters);
            return true;
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '/v1/setParameters'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }
    }
    
    /**
     * Makes the API call to check the image for the specified rules.
     *
     * @param string $file the name (including path) of the image or url of an image that needs to be checked. 
     * @param integer $detail Sets the response details. Use 1 (default) for minimum detail (better API performance), 2 for medium details and 3 for all details.
     * @param string $rule the given name of the rule set. Omit if the cost of the last set rule set should be determined.
     * @param integer $licenseId the id of the license key to use. Omit if the next available license key should be used.
     * @throws IrisnetException is thrown in case that the rule name could not be found, if the license id does not exist, 
     * if the license key is not active or out of credits, if the specified filename does not exist 
     * or if the API request fails (will contain the status code and the message returned from the failed API request).
     * @return IrisNet Contains information on the AI result from the source media check. See <a href="https://www.irisnet.de/api/">API page</a> for more information
     */
    public static function processImage(string $file, int $detail = 1, string $rule = null, int $licenseId = null) : IrisNet
    {

        $isUrl = filter_var($file, FILTER_VALIDATE_URL);

        if (!$isUrl && !file_exists($file)) {
            throw new IrisnetException("The specified file does not exist. Filename: $file", 404);
        }
        
        $usable = self::getUsableLicenses();

        if (empty($usable)) {
            throw new IrisnetException("No usable license keys found. Try adding new licenses or activate existing once.");
        }

        if ($licenseId === null) {
            $license = array_values($usable)[0];
        } else {
            $license = self::getLicenseOption($licenseId, true);
        }
        $key = $license['license'];

        if ($rule !== null) {
            self::setRules($rule);
        }

        $apiInstance = new EndpointsForAIChecksApi(
            new Client(self::getClientConfig(true))
        );

        try {
            if (!$isUrl)
                return $apiInstance->checkImage($key, new \SplFileObject($file), $detail, true);

            return $apiInstance->checkImageUrl($file, $key, $detail, true);
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '/v1/check-image' or '/v1/check-url'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Downloads the modified image as specified by the rules parameters, if needed.
     *
     * @param string $filename the name of the file (without path) that should be downloaded. Is equal to the file name that was processed.
     * @param string $downloadPath the location (folder) of where to save the downloaded file. When omitted the return type is SplFileObject
     * @throws IrisnetException is thrown in case that the API request fails (will contain the status code and the message returned from the failed API request).
     * @return boolean|\SplFileObject returns FALSE in case that the file could not be saved at the specified location
     */
    public static function getProcessedImage(string $filename, string $downloadPath = null) {
        try {
            $apiInstance = new MiscellaneousOperationsApi(
                new Client(self::getClientConfig(true))
            );

            $file = $apiInstance->downloadProcessed($filename);

            if ($downloadPath == null)
                return $file;

            return !file_put_contents($downloadPath . $filename, $file->fread($file->getSize())) ? false : true;
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '/v1/download'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Determines the cost in credits of the rule set.
     *
     * @ignore
     * @param string $rule the given name of the rule set. Omit if the cost of the last set rule set should be determined.
     * @throws IrisnetException is thrown in case that the given rule name could not be found or if the API request fails (will contain the status code and the message returned from the failed API request).
     * @return integer
     */
    public static function getCost(string $rule = null) : int
    {
        if ($rule !== null) {
            $parameters = self::setRules($rule);
        }

        try {
            $apiInstance = new MiscellaneousOperationsApi(
                new Client(self::getClientConfig(true))
            );

            return intval($apiInstance->getAICost());
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '/v1/cost'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Refreshes the credits stats of all active license keys.
     * In case that the API request fails an error notification is displayed in the admin area.
     *
     * @ignore
     * @return void
     */
    public static function refreshCredits()
    {
        $options = get_option('irisnet_plugin_licenses');

        $apiInstance = new MiscellaneousOperationsApi(
            new Client(self::getClientConfig())
        );
        
        $refreshCount = 0;
        $deactivatedCount = 0;
        foreach ($options as $key => $value) {
            if (!isset($value['is_active']) || $value['is_active'] == false) {
                continue;
            }

            $license = $value['license'];

            try {
                $result = $apiInstance->getLicenseInfo($license);

                $options[$key]['credits_used'] = $result->getCreditsUsed();
                $options[$key]['total_credits'] = $result->getTotalCredits();
    
                if ($result->getTotalCredits() != 0 && $result->getCreditsUsed() == $result->getTotalCredits()) {
                    unset($options[$key]['is_active']);
                    $deactivatedCount++;
                }

                $refreshCount++;
            } catch (ApiException $e) {
                add_settings_error('irisnet_connector', $e->getCode(), $e->getMessage() . ' License: ' . $license);
            }
        }

        if ($refreshCount) {
            add_settings_error( 'irisnet_connector', 0, "Refreshed credit stats for $refreshCount license key(s).", 'info' );
        }

        if ($deactivatedCount) {
            add_settings_error( 'irisnet_connector', 0, "$deactivatedCount license key(s) were deactivated, due to their lack of remaining credits.", 'warning' );
        }

        settings_errors('irisnet_connector');

        update_option('irisnet_plugin_licenses', $options);
    }

    private static function getUsableLicenses()
    {
        $active = self::getActiveLicenses();

        $usable = array();
        foreach ($active as $key => $value) {
            if ($value['total_credits'] == 0 || $value['credits_used'] < $value['total_credits']) {
                $usable[$key] = $value;
            }
        }

        return $usable;
    }

    private static function getActiveLicenses()
    {
        $options = get_option('irisnet_plugin_licenses');

        $active = array();
        foreach ($options as $key => $value) {
            if (isset($value['is_active']) && $value['is_active'] == true) {
                $active[$key] = $value;
            }
        }

        return $active;
    }

    private static function getLicenseOption(int $licenseId, bool $onlyUsable = true)
    {
        $options = get_option('irisnet_plugin_licenses');
        if (!isset($options[$licenseId])) {
            throw new IrisnetException("The license with id '$licenseId' could not be found.");
        }

        $license = $options[$licenseId];

        if ($onlyUsable) {
            if (!isset($license['is_active']) || $license['is_active'] === false) {
                throw new IrisnetException("The license with id '$licenseId' is currently deactivated.");
            }

            if ($license['credits_used'] >= $license['total_credits']) {
                throw new IrisnetException("The license with id '$licenseId' is out of credits.");
            }
        }

        return $license;
    }

    /**
     * Creates a parameter model from the given rule set or rule set name.
     *
     * @ignore
     * @param string|array $rule the given name of the rule set or rule set array.
     * @throws IrisnetException is thrown in case that the given rule name could not be found.
     * @throws IrisnetException if the given parameter is not a valid type (string or array)
     * @return INParams Parameter model as it is consumed by the Irisnet API
     */
    public static function createParameterModel($rule) : INParams
    {
        if(is_array($rule) && isset($rule['rule_name'])) {
            $option = $rule;
        } else if(is_string($rule)) {
            $options = get_option('irisnet_plugin_rules');
            if (!isset($options[$rule])) {
                throw new IrisnetException("The rule set named '$rule' could not be found.");
            }
    
            $option = $options[$rule];
        } else {
            throw new InvalidArgumentException("Argument not of expected type. Please provide the name (string) of a rule set.");
        }

        // unset some variables that are not needed in this scope
        unset($option['rule_name']);
        unset($option['description']);
        unset($option['cost']);

        // create INParams object
        $params = new INParams();

        // create and fill INDefault object
        $keys = array_keys($option);
        $default = new INDefault();
        foreach ($keys as $key) {
            $exploded = explode('_', $key, 2);
            if ($exploded[0] === 'default' && $exploded[1] !== 'switch') {
                $default->{'set' . ucfirst($exploded[1])}($option[$key]);
                unset($option[$key]);
            }
        }
        $params->setInDefault($default);

        // create a class object array
        $classObjects = array();
        foreach (array_values(RulesHelper::getClassObjectGroups()) as $group) {
            $classObjects = array_merge($classObjects, array_keys($group));
        }

        // create a group object array
        $groupObjects = array();
        foreach (RulesHelper::getClassObjectGroups(true) as $key => $value) {
            $group = array();
            foreach ($value as $className => $classOptions) {
                if (!$classOptions['allowMinMax'])
                    $group[] = $className;
            }
            $groupObjects[$key] = $group;
        }

        // create and fill INParam objects as needed
        $paramArray = array();
        foreach ($classObjects as $class) {
            $data = array();
            foreach ($option as $key => $value) {
                $exploded = explode('_', $key, 2);
                if (in_array($exploded[0], array_keys($groupObjects)) && $exploded[1] === 'switch') {
                    continue;
                }

                if ($exploded[0] === $class) {
                    if (in_array($exploded[0], array_values($classObjects)) && ($exploded[1] === 'param_switch')) {
                        $data['min'] = '0';
                        $data['max'] = '0';
                    } else {
                        $data[$exploded[1]] = $value;
                    }
                    unset($option[$key]);
                }
            }

            if (!empty($data)) {
                $data['in_class'] = $class;
                $paramArray[] = new INParam($data);
            }
        }

        // Check paramArray for missing inParams from remaining groups within $option. 
        // get all created param classes
        $names = array();
        foreach($paramArray as $param) {
            $names[] = $param->getInClass();
        };

        // flatten groupObjects and find missing from paramArray
        $res = array();
        array_walk_recursive($groupObjects, function($v) use (&$res) { $res[] = $v; });
        $missing = array_diff($res, $names);

        // Create a new inParam for each class with param_switch that was not active: Use data max = -1; draw_mode = 0
        foreach ($option as $key => $value) {
            $groupName = explode('_', $key, 2)[0];

            foreach ($missing as $c) {
                if (!in_array($c, $groupObjects[$groupName]))
                    continue;

                $paramArray[] = new INParam(array(
                    'in_class' => $c,
                    'max' => -1,
                    'draw_mode' => 0
                ));
            }
        }
        
        // fill INParams object
        $params->setInParam($paramArray);

        return $params;
    }

    private static function getClientConfig($withCookie = false, $clearOldCookie = false) : array {
        if ($clearOldCookie && self::$cookieJar) {
            self::$cookieJar->clear();
        }

        if (!self::$cookieJar && $withCookie) {
            self::$cookieJar = new CookieJar();
        }

        $arr = array();

        if ($withCookie && self::$cookieJar) {
            $arr['cookies'] = self::$cookieJar;
        }

        // add further config args here

        return $arr;
    }
}
