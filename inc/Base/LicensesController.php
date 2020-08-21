<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\LicensesCallbacks;
use Inc\Api\Callbacks\AdminCallbacks;

class LicensesController extends BaseController
{
    private $settings;

    private $callbacks;
    private $licenses_callbacks;

    private $subPages = array();
    private $custom_post_types = array();

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->licenses_callbacks = new LicensesCallbacks();

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
                'page_title' => 'Licenses Manager',
                'menu_title' => 'Licenses',
                'capability' => 'manage_options',
                'menu_slug' => 'irisnet_licenses',
                'callback' => array($this->callbacks, 'adminLicenses')
            )
        );
    }

    private function setSettings()
    {
        $args = array(
            array(
                'option_group' => 'irisnet_plugin_licenses_settings',
                'option_name' => 'irisnet_plugin_licenses',
                'callback' => array( $this->licenses_callbacks, 'licensesSanitize' )
            )
        );

        $this->settings->setSettings($args);
    }

    private function setSections()
    {
        $args = array(
            array(
                'id' => 'irisnet_licenses_index',
                'title' => 'Add/Edit License',
                'callback' => array( $this->licenses_callbacks, 'licensesSectionManager' ),
                'page' => 'irisnet_licenses'
            )
        );

        $this->settings->setSections($args);
    }

    private function setFields()
    {
        $args = array(
            array(
                'id' => 'license',
                'title' => 'License',
                'callback' => array( $this->licenses_callbacks, 'textField' ),
                'page' => 'irisnet_licenses',
                'section' => 'irisnet_licenses_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_licenses',
                    'label_for' => 'license',
                    'placeholder' => 'eg. IN-100-1234-1234-1234-1234',
                    'array' => 'id'
                )
            ),
            array(
                'id' => 'is_active',
                'title' => 'Active',
                'callback' => array( $this->licenses_callbacks, 'checkboxField' ),
                'page' => 'irisnet_licenses',
                'section' => 'irisnet_licenses_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_licenses',
                    'label_for' => 'is_active',
                    'class' => 'ui-toggle',
                    'array' => 'id'
                )
            ),
            array(
                'id' => 'id',
                'callback' => array( $this->licenses_callbacks, 'hiddenField' ),
                'page' => 'irisnet_licenses',
                'section' => 'irisnet_licenses_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_licenses',
                    'label_for' => 'id',
                    'array' => 'id'
                )
            )
        );

        $this->settings->setFields($args);
    }
}
