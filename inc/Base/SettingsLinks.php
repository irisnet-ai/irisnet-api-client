<?php
/**
 * @package IrisnetAPIPlugin
 */
namespace Inc\Base;

use Inc\Base\BaseController;

class SettingsLinks extends BaseController
{
    public function register()
    {
        add_filter("plugin_action_links_$this->plugin", array( $this, 'settings_link' ));
    }

    public function settings_link($links)
    {
        $settings_link = '<a href="admin.php?page=irisnet_dash">Settings</a>';
        $api_link = '<a href="https://www.irisnet.de/api/">API</a>';
        $buy_link = '<a href="https://www.irisnet.de/prices/">Buy Credits</a>';
        $emoticon = '<span>&#128525;</span>';
        array_push($links, $settings_link, $api_link, $buy_link, $emoticon);
        return $links;
    }
}
