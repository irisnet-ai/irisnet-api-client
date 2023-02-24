<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc\Helper;

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
	 * Performs an upgrade (Currently not in use).
	 *
	 * @param int $oldDatabaseVersion
	 */
    public static function up($oldDatabaseVersion)
    {
		$migrationMode = self::MODE_UP;

        // Do something
    }

	/**
	 * Performs a downgrade (Currently not in use).
	 *
	 * @param $oldDatabaseVersion
	 */
	public static function down( $oldDatabaseVersion ) 
    {
		$migrationMode = self::MODE_DOWN;

        // Do something
	}
}
