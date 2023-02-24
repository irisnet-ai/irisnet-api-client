<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc;

use Inc\Helper\Migration;

final class Init
{
    /**
     * Store all the classes inside an array
     * @return array Full list of classes
     */
    public static function get_services()
    {
        return [
            Pages\Dashboard::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Base\LicensesController::class,
            Base\RulesController::class
        ];
    }

    /**
     * Loop through the classes, initialize them,
     * and call the register() method if it exists
     * @return
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     * @param  class $class    class from the services array
     * @return class instance  new instance of the class
     */
    private static function instantiate($class)
    {
        $service = new $class();
        return $service;
    }

    /**
     * Migration script.
     */
    public static function migrate()
    {
        $currentPluginVersion = get_option('irisnet_plugin_version');

        if ($currentPluginVersion === false) {
            return;
        }

        if ($currentPluginVersion != IRISNET_API_CLIENT_VERSION) {
            if ($currentPluginVersion < IRISNET_API_CLIENT_VERSION) {
                Migration::up($currentPluginVersion);

                update_option('irisnet_plugin_version', IRISNET_API_CLIENT_VERSION);
            }

            if ($currentPluginVersion > IRISNET_API_CLIENT_VERSION) {
                Migration::down($currentPluginVersion);

                update_option('irisnet_plugin_version', IRISNET_API_CLIENT_VERSION);
            }
        }
    }
}
