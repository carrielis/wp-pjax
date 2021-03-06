<?php
/**
 * PHPUnit bootstrap file
 *
 * @package wp-pjax
 */

// include composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/wp-pjax.php';
}

tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';

global $wp_plugin_paths;
$installed_plugin = dirname( __DIR__ ) . '/vendor/wordpress/wordpress/wp-content/plugins/wp-pjax';
if ( ! is_link( $installed_plugin ) ) {
	// @codingStandardsIgnoreStart
	symlink( dirname( __DIR__ ), $installed_plugin );
	// @codingStandardsIgnoreEnd
}
$wp_plugin_paths[ $installed_plugin ] = realpath( $installed_plugin );
