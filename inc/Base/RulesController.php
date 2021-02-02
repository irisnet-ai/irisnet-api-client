<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\RulesCallbacks;
use Inc\Api\Callbacks\AdminCallbacks;

class RulesController extends BaseController
{
    private $settings;

    private $callbacks;
    private $rules_callbacks;

    private $subPages = array();

    private static $drawModeVars = array(
        0 => 'none',
        1 => 'frame + name',
        2 => 'mask',
        3 => 'mask + frame + name',
        6 => 'blur',
        7 => 'blur + frame + name'
    );

    private static $classObjectGroups = array(
        'Base Parameters' => array (
            'face' => 'faces',
            'hand' => 'hands',
            'foot' => 'feet', 
            'footwear' => 'shoes or similar footwear', 
            'breast' => 'breasts',
            'vulva' => 'vulvae',
            'penis' => 'penises',
            'vagina' => 'vaginae',
            'buttocks' => 'buttocks', 
            'anus' => 'ani', 
        ),
        'Age Estimation' => array(
            'child' => 'child faces',
            'adult' => 'adult faces',
            'senior' => 'senior faces',
            'pose' => 'poses (obstructed or looking to the side)',
        ),
        'Illegal Symbols' => array (
            'illegalSymbols' => 'illegal symbols'
        )
    );

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->rules_callbacks = new RulesCallbacks();

        $this->setSubPages();
        
        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addSubPages($this->subPages)->register();
    }

    private function setSubPages()
    {
        $this->subPages = array(
            array(
                'parent_slug' => 'irisnet_dash',
                'page_title' => 'Rules Management',
                'menu_title' => 'Rules',
                'capability' => 'manage_options',
                'menu_slug' => 'irisnet_rules',
                'callback' => array($this->callbacks, 'adminRules')
            )
        );
    }

    private function setSettings()
    {
        $args = array(
            array(
                'option_group' => 'irisnet_plugin_rules_settings',
                'option_name' => 'irisnet_plugin_rules',
                'callback' => array( $this->rules_callbacks, 'rulesSanitize' )
            )
        );

        $this->settings->setSettings($args);
    }

    private function setSections()
    {
        $args = array(
            array(
                'id' => 'irisnet_rules_index',
                'title' => 'Add/Edit Rule',
                'callback' => array( $this->rules_callbacks, 'rulesSectionManager' ),
                'page' => 'irisnet_rules'
            )
        );

        $this->settings->setSections($args);
    }

    private function setFields()
    {

        $switch = array(
            'callback' => array( $this->rules_callbacks, 'fieldsetSwitch' ),
            'args' => array(
                'option_name' => 'irisnet_plugin_rules',
                'class' => 'ui-toggle',
                'label_for' => 'switch'
            )
        );

        $defaultFields = array(
            array(
                'id' => 'thresh',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'type' => 'number',
                    'step' => '.01',
                    'min' => '0',
                    'max' => '1',
                    'placeholder' => 'e.g. 0.75',
                    'array' => 'rule_name',
                    'description' => 'The AI recognition level (expert setting)',
                    'tooltip' => 'Lowering the value will increase the probability of recognizing objects (e.g. recognizing faces in poorly lit situations). Setting the value too low however, can cause the AI ' .
                        'to see objects where there is similarity (e.g. confuse a dog face for a human face). Use this setting to fine tune the AI, depending on the images you are analyzing. In most cases the default (empty) is the right choice.'
                )
            ),
            array(
                'id' => 'grey',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'type' => 'number',
                    'min' => '0',
                    'max' => '255',
                    'placeholder' => 'e.g. 255',
                    'array' => 'rule_name',
                    'description' => 'A grey scale color to use for frame or masking. Is only applied on the output image.',
                    'tooltip' => '0 will represent black, while the maximum 255 will be white'
                )
            )
        );

        $groupFields = array();
        foreach (self::$classObjectGroups as $groupName => $classes) {
            
            $classFields = array();
            foreach ($classes as $className => $plural) {

                $paramFields = array();
                // we do not want the user to set min or max values for illegal symbols
                if ($className !== 'illegalSymbols') {
                    $paramFields = array(
                        array(
                            'id' => 'min',
                            'callback' => array( $this->rules_callbacks, 'textField' ),
                            'args' => array(
                                'option_name' => 'irisnet_plugin_rules',
                                'type' => 'number',
                                'min' => '0',
                                'placeholder' => 'e.g. 0',
                                'array' => 'rule_name',
                                'description' => "Minimum amount of $plural.",
                                'tooltip' => "Define the minimum amount of $plural that should be found to pass the check."
                            )
                        ),
                        array(
                            'id' => 'max',
                            'callback' => array( $this->rules_callbacks, 'textField' ),
                            'args' => array(
                                'option_name' => 'irisnet_plugin_rules',
                                'type' => 'number',
                                'min' => '-1',
                                'placeholder' => 'e.g. 5',
                                'array' => 'rule_name',
                                'description' => "Maximum amount of $plural.",
                                'tooltip' => "Define the maximum amount of $plural that should be found to pass the check. Use -1 to ignore the maximum count"
                            )
                        )
                    );
                }
                $paramFields[] = array(
                    'id' => 'draw_mode',
                    'callback' => array( $this->rules_callbacks, 'selectField' ),
                    'args' => array(
                        'option_name' => 'irisnet_plugin_rules',
                        'select_options' => self::$drawModeVars,
                        'array' => 'rule_name',
                        'description' => 'Define how the image will be censored.',
                        'tooltip' => 'Is only applied on the output image.'
                    )
                );
                $paramFields = array_merge($paramFields, array($defaultFields[1]));

                
                // we have different descriptions for cases were there is no min or max input fields
                if ($className !== 'illegalSymbols') {
                    $description = "Define how many $plural should be allowed (min/max values) on an image and what the censored image should look like (draw mode and color).";
                } else {
                    $description = "Define how the $plural should censored in the output image (draw mode and color).";
                }

                $classFields[] = array(
                    'id' => $className,
                    'callback' => array( $this->rules_callbacks, 'infoText' ),
                    'page' => 'irisnet_rules',
                    'section' => 'irisnet_rules_index',
                    'args' => array(
                        'option_name' => 'irisnet_plugin_rules',
                        'title' => ucfirst($className). ' Parameters',
                        'label_for' => $className,
                        'description' => $description,
                        'fields' => $paramFields
                    )
                );
            }

            $groupId = lcfirst(str_replace(' ', '', $groupName));
            $groupFields[] = array(
                'id' => $groupId,
                'title' => ucfirst($groupName),
                'callback' => array( $this->rules_callbacks, 'fieldset' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'label_for' => $groupId,
                    'switch' => $switch,
                    'fields' => $classFields,
                    'extend_name' => false,
                    'compact' => true
                )
            );
        }

        $args = array(
            array(
                'id' => 'rule_name',
                'title' => 'Rule Set Name',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'label_for' => 'rule_name',
                    'required' => true,
                    'placeholder' => 'e.g. profile_picture',
                    'array' => 'rule_name',
                    'description' => 'Your custom name for the rule set.'
                )
            ),
            array(
                'id' => 'description',
                'title' => 'Description',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'label_for' => 'description',
                    'required' => true,
                    'placeholder' => 'e.g. Allow one person to appear in the picture.',
                    'array' => 'rule_name',
                    'description' => 'Describe the characteristics of the rule set.'
                )
            ),
            array(
                'id' => 'default',
                'title' => 'Common settings (Defaults)',
                'callback' => array( $this->rules_callbacks, 'fieldset' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'label_for' => 'default',
                    'description' => 'Define base settings that are valid for all of the following parameters. ' .
                        'Single parameter settings can be still overwritten within each object if needed. ' .
                        'Leave this option off, if you don\'t want to fine tune the AI. ' .
                        '<br>See INDefault Schema in <a href="https://irisnet.de/api" target="_blank">API Documentation</a> for further information.',
                    'switch' => $switch,
                    'fields' => $defaultFields,
                    'extend_name' => true
                )
            ),
            array(
                'id' => 'parameter_info_text',
                'callback' => array( $this->rules_callbacks, 'infoText' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'description' => '<b>The following options, within the toggle groups, represent the classification objects (e.g. face, hand, child, breast) recognized by the irisnet AI. ' .
                        'Each classification or their parameter settings within can be left off or empty. In that case default settings will applied.</b>' .
                        '<br>See INParam Schema in <a href="https://irisnet.de/api" target="_blank">API Documentation</a> for further information ' .
                        'on each classification object and their default settings.',
                )
            )
        );
        $args = array_merge($args, $groupFields);

        $this->settings->setFields($args);
    }

    /**
     * Get the value of drawModeVars
     */ 
    public static function getDrawModeVars()
    {
        return self::$drawModeVars;
    }

    /**
     * Get the value of classObjectGroups
     */ 
    public static function getClassObjectGroups()
    {
        return self::$classObjectGroups;
    }
}
