<?php
/**
 * @package IrisnetAPIClient
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
                'page_title' => 'Irisnet API Client',
                'menu_title' => 'Irisnet API',
                'capability' => 'manage_options',
                'menu_slug' => 'irisnet_dash',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($this->plugin_path . 'assets/irisnet_icon.svg')),
                'position' => 100
            )
        );
    }
}
