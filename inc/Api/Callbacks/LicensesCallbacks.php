<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Api\Callbacks;

use \GuzzleHttp\Client;
use \Irisnet\APIV2\Client\ApiException;
use \Irisnet\APIV2\Client\Api\BalanceEndpointsApi;
use \Irisnet\APIV2\Client\Configuration as APIConfiguration;

class LicensesCallbacks
{
    public function licensesSectionManager()
    {
        echo 'Add Irisnet Credits Licenses here. Go to <a href="https://irisnet.de/subscribe">irisnet.de</a> to obtain credits.';
    }

    public function licensesSanitize($input)
    {
        // avoid execution of this function, when we update the
        // options from IrisnetAPIConnector::refreshCredits()
        if (isset($_POST['refresh_credits'])) {
            return $input;
        }

        $output = get_option('irisnet_plugin_licenses');

        // User requested removal of data set
        if (isset($_POST["remove"])) {
            unset($output[sanitize_text_field($_POST["remove"])]);
            return $output;
        }

        // Sanitize and validate user input
        $input['license'] = str_replace('"', "", $input['license']);
        $input['license'] = str_replace("'", "", $input['license']);
        $args = array(
            'license'   => FILTER_SANITIZE_STRING,
            'is_active'    => FILTER_VALIDATE_BOOLEAN,
            'id'     => FILTER_VALIDATE_INT
        );
        $input = filter_var_array($input, $args);

        // generate id from options count if no id is given
        ksort($output);
        $licenseId = $input['id'];
        unset($input['id']);
        if (empty($licenseId)) {
            $licenseId = array_key_last($output) + 1; // php >= 7.3
        }
            
        // Check the license api in case the user sets license to active
        if (isset($input['is_active'])) {
            $apiConfig = APIConfiguration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', $input['license']);
            $apiInstance = new BalanceEndpointsApi(
                null, // using default `GuzzleHttp\Client`
                $apiConfig
            );
            
            try {
                $result = $apiInstance->getLicenseInfo();

                $input['credits_used'] = $result->getCreditsUsed();
                $input['total_credits'] = $result->getTotalCredits();

                if ($result->getTotalCredits() != 0 && $result->getCreditsUsed() == $result->getTotalCredits())
                    unset($input['is_active']);
            } catch (ApiException $e) {
                add_settings_error('irisnet_plugin_licenses', $e->getCode(), $e->getMessage());
                return $output;
            }
        }
        
        // first entry
        if (count($output) == 0) {
            $output[$licenseId] = $input;
            return $output;
        }

        foreach ($output as $key => $value) {
            // overwrite dataset if id already exists
            if ($licenseId == $key) {
                if (!isset($input['is_active'])) {
                    unset($output[$key]['is_active']);
                }
                $output[$key] = array_merge($output[$key], $input);
                return $output;
            }

            // return if license already exists
            if ($input['license'] === $value['license']) {
                add_settings_error('irisnet_plugin_licenses', 400, 'License already exists.', 'warning');
                return $output;
            }
        }

        // all other checks failed, so lets finally save the dataset
        $output[$licenseId] = $input;
        return $output;
    }

    public function hiddenField($args)
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];
        
        $placeholder = '';
        if (isset($args['placeholder'])) {
            $placeholder = 'placeholder="' . $args['placeholder'] . '"';
        }

        $value = '';
        if (isset($_POST["edit_license"])) {
            $value = sanitize_text_field($_POST["edit_license"]);
        }

        echo '<input type="hidden" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" ' . $placeholder . '>';
    }

    public function textField($args)
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];
        $value = '';

        if (isset($_POST["edit_license"])) {
            $option = get_option($option_name);
            $value = $option[sanitize_text_field($_POST["edit_license"])][$name];
        }

        echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '" required>';
    }

    public function checkboxField($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        
        $checked = false;
        if (isset($_POST["edit_license"])) {
            $checkbox = get_option($option_name);
            $checked = isset($checkbox[$_POST["edit_license"]][$name]) ?: false;
        }

        echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" ' . ($checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
    }
}
