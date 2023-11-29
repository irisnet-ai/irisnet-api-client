<?php
/**
 * @package IrisnetAPIClient
 */
namespace Migrations;

use \Inc\IrisnetAPIConnector;
use \Inc\Helper\RulesHelper;
use \Irisnet\APIV2\Client\Model\Config;
use \Irisnet\APIV2\Client\Model\Param;
use \Irisnet\APIV2\Client\Model\ParamSet;

class From_1_8_13
{

	/**
	 * Performs an upgrade.
	 */
    public static function up()
    {
        // retrieve the options from the database
        $options = get_option('irisnet_plugin_rules');
		$newOptions = array();

		foreach ($options as $rule) {
			$newRule = IrisnetAPIConnector::setConfig($rule);

			$newRule['rule_name'] = $rule['rule_name'];
			$newRule['description'] = $rule['description'];
			$newRule['cost'] = IrisnetAPIConnector::getCost($newRule['id'], $newRule['license']);
			
			$newOptions[$rule['rule_name']] = $newRule;
		}

		// update the options in the database
		update_option('irisnet_plugin_rules', $newOptions);
    }

	/**
	 * Performs a downgrade.
	 */
	public static function down() 
    {
        // no way back
	}
}
