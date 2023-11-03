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
        return require_once("$this->plugin_path/templates/rules.php");
    }

    public function adminLicenses()
    {
        return require_once("$this->plugin_path/templates/licenses.php");
    }
}
