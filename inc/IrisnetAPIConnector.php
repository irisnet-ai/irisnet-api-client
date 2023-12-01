<?php
/**
 * @package IrisnetAPIClient
 */

namespace Inc;

use \GuzzleHttp\Client;
use \Exception;
use Inc\Helper\RulesHelper;
use \Irisnet\APIV2\Client\Model\Pricing;
use \Irisnet\APIV2\Client\Model\CheckResult;
use \Irisnet\APIV2\Client\ApiException;
use \Irisnet\APIV2\Client\Configuration as APIConfiguration;
use \Irisnet\APIV2\Client\Api\ConfigurationManagementApi;
use \Irisnet\APIV2\Client\Api\DetailedConfigurationParametersApi;
use \Irisnet\APIV2\Client\Api\BalanceEndpointsApi;
use \Irisnet\APIV2\Client\Api\AICheckOperationsApi;
use \Irisnet\APIV2\Client\Model\LicenseInfo;
use \Irisnet\APIV2\Client\Model\Config;
use \Irisnet\APIV2\Client\Model\Param;
use \Irisnet\APIV2\Client\Model\ParamSet;

/**
 * Helper class to connect to the irisnet API.
 */
class IrisnetAPIConnector
{

    /**
     * Sets the rules that should be used for the upcoming checks.
     *
     * @param string|array $rule the given name of the rule set.
     * @param string $license the license key to use. Omit if the next available license key should be used.
     * @throws IrisnetException is thrown in case that there are no active licenses or if the API request fails (will contain the status code and the message returned from the failed API request).
     * @return array the 'id' of the created configuration and the 'license' used to create the configuration.
     */
    public static function setConfig($rule, $license = null) : array
    {
        if ($license == null) {
            $licenses = self::getActiveLicenses();
            if ( empty($licenses) )
                throw new Exception("No active license keys found. Try adding new licenses or activate existing once.");
            $license = $licenses[0]['license'];
        }

        /** @var Config $config */
        $config = IrisnetAPIConnector::createConfigModel($rule);
        
        /** @var ParamSet $params */
        $params = IrisnetAPIConnector::createParameterModel($rule);

        // Configure API key authorization: LICENSE-KEY
        $apiConfig = APIConfiguration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', $license);

        $id = null;
        try {
            $apiInstance = new ConfigurationManagementApi(
                null, // using default `GuzzleHttp\Client`
                $apiConfig
            );

            /** @var Config $result */
            $result = $apiInstance->setConfig($config);

            $id = $result->getId();
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '[POST] /v2/config'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }

        if ($id === null)
            throw new IrisnetException("The configuration could not be created. The API returned an empty id.");
            
        try {
            $apiInstance = new DetailedConfigurationParametersApi(
                null, // using default `GuzzleHttp\Client`
                $apiConfig
            );
            $apiInstance->setParameters($id, $params);
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '[POST] /v2/config/parameters'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }

        return array(
            'id' => $id,
            'license' => $license
        );
    }

    /**
     * Deletes the AI configuration
     *
     * @param string $id the id of the configuration
     * @param string $license the license key to use. Omit if the next available license key should be used.
     * @throws IrisnetException is thrown in case that there are no active licenses or if the API request fails (will contain the status code and the message returned from the failed API request).
     * @return bool the id of the created created configuration.
     */
    public static function deleteConfig(string $id, $license = null) : bool
    {
        if ($license == null) {
            $licenses = self::getActiveLicenses();
            if ( empty($licenses) )
                throw new Exception("No active license keys found. Try adding new licenses or activate existing once.");
            $license = $licenses[0]['license'];
        }

        // Configure API key authorization: LICENSE-KEY
        $apiConfig = APIConfiguration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', $license);

        try {
            $apiInstance = new ConfigurationManagementApi(
                null, // using default `GuzzleHttp\Client`
                $apiConfig
            );

            $result = $apiInstance->deleteConfig($id);
            return true;
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '[DELETE] /v2/config'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Retrieves the config and the parameters for the given config id and license key.
     *
     * @ignore
     * @param string $id the id of the configuration
     * @param string $license the license key where the id belongs to.
     * @throws IrisnetException is thrown in case that the given rule name could not be found or if the API request fails (will contain the status code and the message returned from the failed API request).
     * @return array the config and the parameters for the given config id and license key.
     */
    public static function getConfig(string $id, string $license) : array
    {
        // Configure API key authorization: LICENSE-KEY
        $apiConfig = APIConfiguration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', $license);

        /** @var Config $config */
        $config = null;

        /** @var ParamSet $params */
        $params = null;

        try {
            $apiInstance = new ConfigurationManagementApi(
                null, // using default `GuzzleHttp\Client`
                $apiConfig
            );

            $config = $apiInstance->getConfig($id);
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '[GET] /v2/config/{configId}'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }

        try {
            $apiInstance = new DetailedConfigurationParametersApi(
                null, // using default `GuzzleHttp\Client`
                $apiConfig
            );

            $params = $apiInstance->getParameters($id);
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '[GET] /v2/config/parameters/{configId}'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }

        return array(
            'prototypes' => $config,
            'paramSet' => $params
        );
    }

    /**
     * Determines the cost in credits of the rule set.
     *
     * @ignore
     * @param string $id the id of the configuration
     * @param string $license the license key where the id belongs to.
     * @throws IrisnetException is thrown in case that the given rule name could not be found or if the API request fails (will contain the status code and the message returned from the failed API request).
     * @return integer
     */
    public static function getCost(string $id, string $license) : int
    {
        // Configure API key authorization: LICENSE-KEY
        $apiConfig = APIConfiguration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', $license);

        try {
            $apiInstance = new BalanceEndpointsApi(
                null, // using default `GuzzleHttp\Client`
                $apiConfig
            );

            /** @var Pricing $pricing */
            $pricing = $apiInstance->getCost($id);

            return $pricing->getCost();
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '[GET] /v2/cost/{configId}'. ApiResponse: " . $e->getMessage(), $e->getCode());
        }
    }
    
    /**
     * Makes the API call to check the image for the specified rules.
     *
     * @param string $file the name (including path) of the image or url of an image that needs to be checked. 
     * @param string $rule the given name of the rule set.
     * @param integer $detail Sets the response details. Use 1 (default) for minimum detail (better API performance), 2 for medium details and 3 for all details.
     * @param integer $licenseId the id of the license key to use. Omit if the next available license key should be used.
     * @throws IrisnetException is thrown in case that the rule name could not be found, if the license id does not exist, 
     * if the license key is not active or out of credits, if the specified filename does not exist 
     * or if the API request fails (will contain the status code and the message returned from the failed API request).
     * @return CheckResult Contains information on the AI result from the source media check. See <a href="https://www.irisnet.de/api/">API page</a> for more information
     */
    public static function checkImage(string $file, string $rule, int $detail = 1, int $licenseId = null) : CheckResult
    {

        $isUrl = filter_var($file, FILTER_VALIDATE_URL);

        if (!$isUrl && !file_exists($file)) {
            throw new IrisnetException("The specified file does not exist. Filename: $file", 404);
        }

        if (!$isUrl) {
            $type = pathinfo($file, PATHINFO_EXTENSION);
            $data = file_get_contents($file);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
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

        $rule = self::getRuleOption($rule);
        $configId = $rule['id'];

        // Configure API key authorization: LICENSE-KEY
        $apiConfig = APIConfiguration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', $key);

        $apiInstance = new AICheckOperationsApi(
            null, // using default `GuzzleHttp\Client`
            $apiConfig
        );

        try {
            return $apiInstance->checkImage($configId, null, isset($base64) ? $base64 : $file, $detail, true);
        } catch (ApiException $e) {
            throw new IrisnetException("An Exception occurred while performing the API request '/v2/check-image/{configId}'. ApiResponse: " . $e->getMessage(), $e->getCode());
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

        $refreshCount = 0;
        $deactivatedCount = 0;
        foreach ($options as $key => $value) {
            if (!isset($value['is_active']) || $value['is_active'] == false) {
                continue;
            }

            $license = $value['license'];
            
            // Configure API key authorization: LICENSE-KEY
            $apiConfig = APIConfiguration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', $license);
            $apiInstance = new BalanceEndpointsApi(
                null, // using default `GuzzleHttp\Client`
                $apiConfig
            );

            try {
                /** @var LicenseInfo $result */
                $result = $apiInstance->getLicenseInfo();

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
        foreach ($options as $value) {
            if (isset($value['is_active']) && $value['is_active'] == true) {
                $active[] = $value;
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
     * Creates a prototypes config model from the given rule set or rule set name.
     *
     * @ignore
     * @param string|array $rule the given name of the rule set or rule set array.
     * @throws IrisnetException is thrown in case that the given rule name could not be found.
     * @throws InvalidArgumentException if the given parameter is not a valid type (string or array)
     * @return Config Config model with prototypes as it is consumed by the Irisnet API
     */
    public static function createConfigModel($rule) : Config
    {
        $rule = self::getRuleOption($rule);

        // get all prototypes
        $prototypes = array_keys(RulesHelper::getSimplifiedClassObjectArray());

        // filter parameters used
        $parameters = array_unique(array_map(function ($v) {
            return substr($v, 0, strpos($v, '_'));
        }, array_keys($rule)));

        // change prototype 'baseParameters' to 'nudityCheck'
        // keep for downward compatibility
        $prototypes = array_map(function($v) {
            return $v === 'baseParameters' ? 'nudityCheck' : $v;
        }, $prototypes);
        $parameters = array_map(function($v) {
            return $v === 'baseParameters' ? 'nudityCheck' : $v;
        }, $parameters);

        // filter $prototypes for elements that are in both arrays
        $prototypes = array_intersect($prototypes, $parameters);

        // return prototypes config
        return new Config(array('prototypes' => array_values($prototypes)));
    }

    /**
     * Creates a parameter model from the given rule set or rule set name.
     *
     * @ignore
     * @param string|array $rule the given name of the rule set or rule set array.
     * @throws IrisnetException is thrown in case that the given rule name could not be found.
     * @throws InvalidArgumentException if the given parameter is not a valid type (string or array)
     * @return ParamSet Parameter set model as it is consumed by the Irisnet API
     */
    public static function createParameterModel($rule) : ParamSet
    {
        $rule = self::getRuleOption($rule);

        // get all prototypes
        $prototypes = array_keys(RulesHelper::getSimplifiedClassObjectArray());

        // remove classification names that are also prototype names
        $prototypes = array_filter($prototypes, function($v) {
            return RulesHelper::findClassParent($v) === false;
        });

        // filter parameters used
        $parameters = array_unique(array_map(function ($v) {
            return substr($v, 0, strpos($v, '_'));
        }, array_keys($rule)));

        // remove filtered prototype values from parameters
        $parameters = array_diff($parameters, $prototypes, array('baseParameters', 'default') /* keep 'baseParameters' for downward compatibility */);

        // remove elements ending with _switch from $options
        $rule = array_filter($rule, function($v, $k) {
            return strpos($k, '_switch') === false;
        }, ARRAY_FILTER_USE_BOTH);

        // loop through parameters and create Prarameter objects
        $params = array();
        foreach ($parameters as $parameter) {
            // filter $rule array for elements with keys starting with $parameter
            $paramData = array_filter($rule, function($k) use ($parameter) {
                return strpos($k, $parameter) === 0;
            }, ARRAY_FILTER_USE_KEY);

            // remove first part of the key matching the $parameter string
            $tmp = array();
            array_walk($paramData, function($v, $k) use (&$tmp, $parameter) {
                $tmp[substr($k, strlen($parameter) + 1)] = $v;
            });
            $paramData = $tmp;
            
            // add min/max (0, 0) values if missing and allowMinMax is false
            $allowMinMax = RulesHelper::getClassObjectGroups(true)[RulesHelper::findClassParent($parameter)][$parameter]['allowMinMax'];
            if ( ! $allowMinMax ) {
                if ( ! array_key_exists('min', $paramData) ) {
                    $paramData['min'] = 0;
                }
                if ( ! array_key_exists('max', $paramData) ) {
                    $paramData['max'] = 0;
                }
            }

            $paramData['classification'] = $parameter;

            // create Param object
            $params[] = new Param($paramData);
        }


        // create ParamSet object
        /** @var ParamSet $paramSet */
        $paramSet = new ParamSet(array('params' => $params));

        // set the default values
        if ( isset($rule['default_thresh']) )
            $paramSet->setThresh($rule['default_thresh']);
        if ( isset($rule['default_grey']) )
            $paramSet->setGrey($rule['default_grey']);

        
        return $paramSet;
    }

    public static function getRuleOption($rule) : array
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
            throw new \InvalidArgumentException("Argument not of expected type. Please provide the name (string) of a rule set.");
        }

        // unset some variables that are not needed in this scope
        unset($option['rule_name']);
        unset($option['description']);
        unset($option['cost']);

        return $option;
    }
}
