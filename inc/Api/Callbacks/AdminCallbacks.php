<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Api\Callbacks;

use Inc\IrisnetAPIConnector;
use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard()
    {
        return require_once("$this->plugin_path/templates/dash.php");
    }

    public function adminRules()
    {
        if ( isset($_POST['rule_error']) )
            add_settings_error('irisnet_plugin_rules', $_POST['rule_error_code'], $_POST['rule_error_message'], 'error');
        return require_once("$this->plugin_path/templates/rules.php");
    }

    public function adminLicenses()
    {
        return require_once("$this->plugin_path/templates/licenses.php");
    }
}
