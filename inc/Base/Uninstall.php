<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Base;

class Uninstall
{
    public static function uninstall()
    {
        delete_option( 'irisnet_plugin_version' );
        delete_option( 'irisnet_plugin_rules' );
        delete_option( 'irisnet_plugin_licenses' );
    }
}
