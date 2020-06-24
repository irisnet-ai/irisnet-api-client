<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package IrisnetAPIPlugin
 */

defined('WP_UNINSTALL_PLUGIN') or die;

delete_option('irisnet_plugin_rules');
delete_option('irisnet_plugin_licenses');
