<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Base;

class BaseController
{
    protected $plugin_path;
    protected $plugin_url;
    protected $plugin;

    public function __construct()
    {
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = plugin_basename(dirname(__FILE__, 3)) . '/irisnet-api-client.php';
    }
}
