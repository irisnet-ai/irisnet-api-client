<?php
/**
 * @package IrisnetAPIPlugin
 */
namespace Inc\Api\Callbacks;

use \GuzzleHttp\Client;
use \OpenAPI\Client\ApiException;
use \OpenAPI\Client\Api\LicenseKeyOperationsApi;

class LicensesCallbacks
{
    public function licensesSectionManager()
    {
        echo 'Add Irisnet Credits Licenses here. Go to <a href="https://www.irisnet.de/prices">irisnet.de</a> to obtain credits.';
    }

    public function licensesSanitize($input)
    {
        // avoid execution of this function, when we update the
        // options from IrisnetAPIConnector::refreshCredits()
        if (isset($_POST['refresh_credits'])) {
            return $input;
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

        $output = get_option('irisnet_plugin_licenses');

        // generate id from options count if no id is given
        ksort($output);
        $licenseId = $input['id'];
        unset($input['id']);
        if (empty($licenseId)) {
            $licenseId = end(array_keys($output)) + 1;
            //$licenseId = array_key_last($output) + 1; // php >= 7.3
        }

        // User requested removal of data set
        if (isset($_POST["remove"])) {
            unset($output[$_POST["remove"]]);
            return $output;
        }
            
        // Check the license api in case the user sets license to active
        if (isset($input['is_active'])) {
            $apiInstance = new LicenseKeyOperationsApi(
                new Client()
            );
            $license_key = $input['license'];
            
            try {
                $result = $apiInstance->getLicenseInfo($license_key);

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
            $value = esc_attr($_POST["edit_license"]);
        }

        echo '<input type="hidden" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" ' . $placeholder . '>';
    }

    public function textField($args)
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];
        $value = '';

        if (isset($_POST["edit_license"])) {
            $input = get_option($option_name);
            $value = esc_attr($input[$_POST["edit_license"]][$name]);
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
