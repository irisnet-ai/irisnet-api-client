<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Base;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();

        $default = array();

        // Plugin version is always updated
        update_option('irisnet_plugin_version', IRISNET_API_CLIENT_VERSION);

        if (! get_option('irisnet_plugin_rules')) {
            update_option('irisnet_plugin_rules', $default);
        }

        if (! get_option('irisnet_plugin_licenses')) {
            update_option('irisnet_plugin_licenses', $default);
        }
    }
}
