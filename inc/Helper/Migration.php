<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Helper;

use Migrations\From_1_8_13;

class Migration
{
	/**
	 * @var string
	 */
	const MODE_UP = 'UP';

	/**
	 * @var string
	 */
	const MODE_DOWN = 'DOWN';

	/**
	 * Performs an upgrade.
	 *
	 * @param int $oldDatabaseVersion
	 */
    public static function up($oldDatabaseVersion)
    {
		$migrationMode = self::MODE_UP;

        switch ($oldDatabaseVersion) {
			case "1.8.13":
				From_1_8_13::up();
				break;
		}
    }

	/**
	 * Performs a downgrade.
	 *
	 * @param $oldDatabaseVersion
	 */
	public static function down( $oldDatabaseVersion ) 
    {
		$migrationMode = self::MODE_DOWN;

        switch ($oldDatabaseVersion) {
			case "1.8.13":
				From_1_8_13::down();
				break;
		}
	}
}
