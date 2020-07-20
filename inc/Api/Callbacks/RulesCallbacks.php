<?php
/**
 * @package IrisnetAPIPlugin
 */
namespace Inc\Api\Callbacks;

use \Exception;
use \GuzzleHttp\Client;
use \IrisnetAPIConnector;
use \GuzzleHttp\Cookie\CookieJar;
use \OpenAPI\Client\ApiException;
use \OpenAPI\Client\Api\AIOperationsApi;
use \OpenAPI\Client\Api\LicenseKeyOperationsApi;

class RulesCallbacks
{

    public function rulesSectionManager()
    {
        echo 'Create your custom rules. See the <a href="https://www.irisnet.de/api" target="_blank">API Documentation</a> for further details.';
    }

    public function rulesSanitize($input)
    {
        // Remove empty values
        $input = array_filter($input, 'strlen');

        // retrieve the options from the database
        $output = get_option('irisnet_plugin_rules');

        // User requested removal of rule set
        if (isset($_POST["remove"])) {
            unset($output[$_POST["remove"]]);

            return $output;
        }
        
        // Determine the cost of the rule set
        try {
            // create cookie jar to remain in the same session for both calls
            $cookieJar = new CookieJar();

            $params = IrisnetAPIConnector::createParameterModel($input);

            // set the parameters 
            $apiInstance = new AIOperationsApi(
                new Client([
                    'cookies' => $cookieJar
                ])
            );
            $apiInstance->setINParams($params);

            // check cost of rule set
            $apiInstance = new LicenseKeyOperationsApi(
                new Client([
                    'cookies' => $cookieJar
                ])
            );
            $input['cost'] = $apiInstance->getAICost();

            $cookieJar->clear();
        } catch (ApiException $e) {
            add_settings_error('irisnet_plugin_rules', $e->getCode(), $e->getMessage());
        } catch (Exception $e) {
            add_settings_error('irisnet_plugin_rules', 500, $e->getMessage());
        }

        // first entry
        if (count($output) == 0) {
            $output[$input['rule_name']] = $input;

            return $output;
        }

        // overwrite entry if exists otherwise add new
        foreach ($output as $key => $value) {
            if ($input['rule_name'] === $key) {
                $output[$key] = $input;
            } else {
                $output[$input['rule_name']] = $input;
            }
        }
        
        return $output;
    }

    public function textField($args)
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];

        $type = !isset($args['type']) ? 'text' : $args['type'];
        $step = !isset($args['step']) ? 'any' : $args['step'];
        $min = isset($args['min']) ? 'min="' . $args['min'] . '"' : '';
        $max = isset($args['max']) ? 'max="' . $args['max'] . '"' : '';


        $required = isset($args['required']) && $args['required'] == true ? 'required' : '';

        $value = '';
        $readonly = '';
        if (isset($_POST["edit_rule"])) {
            $input = get_option($option_name);
            $value = isset($input[$_POST["edit_rule"]][$name]) ? $input[$_POST["edit_rule"]][$name] : '';

            if($name == $args['array']) {
                $readonly = 'readonly';
            }
        }

        if (isset($args['tooltip'])) {
            echo '<div class="tooltip">&#9432;<span class="tooltiptext">' . $args['tooltip'] . '</span></div>&nbsp;';
        }

        echo '<input type="' . $type . '" step="' . $step . '" ' . $min . ' ' . $max . ' class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '" ' . $required . ' ' . $readonly . '>';
        if (isset($args['description'])) {
            echo '<p class="help-text">' . $args['description'] . '</p>';
        } else {
            echo '<br/><br/>';
        }
    }

    public function selectField($args)
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];
        $select_options = $args['select_options'];

        $saved = '';
        if (isset($_POST["edit_rule"])) {
            $input = get_option($option_name);
            $saved = isset($input[$_POST["edit_rule"]][$name]) ? $input[$_POST["edit_rule"]][$name] : '';
        }

        if (isset($args['tooltip'])) {
            echo '<div class="tooltip">&#9432;<span class="tooltiptext">' . $args['tooltip'] . '</span></div>&nbsp;';
        }

        echo '<select id="' . $name . '" name="' . $option_name . '[' . $name . ']" >';
        echo '<option value></option>';
        foreach ($select_options as $key => $option) {
            echo '<option value="' . $key . '" ' . ($saved === strval($key) ? 'selected' : '') . '>' . $option . '</option>';
        }

        echo '</select>';
        if (isset($args['description'])) {
            echo '<p class="help-text">' . $args['description'] . '</p>';
        } else {
            echo '<br/><br/>';
        }
    }

    public function infoText($args)
    {
        echo '<p class="help-text">' . $args['description'] . '</p>';
    }

    public function fieldsetSwitch($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];

        $option_name = '';
        if (isset($args['option_name'])) {
            $option_name = 'name="' . $args['option_name'] . '[' . $name . ']"';
        }

        $checked = isset($args['checked']) ? $args['checked'] : false;

        echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" ' . $option_name . ' value="1" ' . ($checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';

        $description = '';
        if (isset($args['description'])) {
            $description = $args['description'];
        }
        echo '<p class="help-text">' . $description . '</p>';
    }

    public function fieldset($args)
    {
        $name = $args['label_for'];
        $fields = $args['fields'];

        $hidden = true;
        if (isset($_POST["edit_rule"])) {
            $option = get_option($args['option_name']);

            $keys = array_keys($option[$_POST["edit_rule"]]);
            foreach ($keys as $key) {
                if (strpos($key, $name) === 0) {
                    $hidden = false;
                    break;
                }
            }
        }

        if (isset($args['switch'])) {
            $switch = $args['switch'];
            $switch['args']['label_for'] = $name . '_' . $switch['args']['label_for'];
            if (isset($args['description'])) {
                $switch['args']['description'] = $args['description'];
            }
            $switch['args']['checked'] = !$hidden;

            $switch['callback']($switch['args']);
        }

        echo '<fieldset name="' . $name . '" ' . ($hidden ? 'hidden' : '') . '>';

        foreach ($fields as $field) {
            $field['id'] = $name . '_' . $field['id'];
            $field['args']['label_for'] = $field['id'];

            $field['callback']($field['args']);
        }

        echo '</fieldset>';
    }
}
