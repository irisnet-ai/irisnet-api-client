<?php
/**
 * @package IrisnetAPIPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class Dashboard extends BaseController
{
    private $settings;

    private $callbacks;

    private $pages = array();

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->createPages();

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->register();
    }

    private function createPages()
    {
        $this->pages = array(
            array(
                'page_title' => 'Irisnet API Plugin',
                'menu_title' => 'Irisnet API',
                'capability' => 'manage_options',
                'menu_slug' => 'irisnet_dash',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => $this->plugin_url . 'assets/irisnet_icon_f1f2f3.svg',
                'position' => 100
            )
        );
    }
}
