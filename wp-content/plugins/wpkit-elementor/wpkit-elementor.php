<?php
/**
 * Plugin Name: WPKit For Elementor
 * Plugin URI: https://plugins.focuxtheme.com/wpkit-elementor
 * Description: WPKit For Elementor plugin offers more advance Elementor widgets, flexible panel and global block module.
 * Version: 1.1.0
 * Author: FocuxTheme
 * Author URI: https://focuxtheme.com
 * Text Domain: wpkit-elementor
 * Domain Path: /languages/
 *
 * @package WPKit For Elementor
 */

defined( 'ABSPATH' ) || exit;


// Define WKE_PLUGIN_FILE.
if ( ! defined( 'WKE_FILE' ) ) {
	define( 'WKE_FILE', __FILE__ );
}

// Include the main WPKit For Elementor class.
if ( ! class_exists( 'WPKit_Elementor' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-wpkit-elementor.php';
}

/**
 * Returns the main instance of WPKit_Elementor.
 *
 * @since  1.0
 * @return WPKit_Elementor
 */
function WPKit_Elementor() {
	return WPKit_Elementor::instance();
}

// Global for backwards compatibility.
$GLOBALS['WPKit_Elementor'] = WPKit_Elementor();

require_once dirname( __FILE__ ) . "/includes/plugin-update-checker/plugin-update-checker.php";
$WKE_UpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://focuxtheme.com/update-server/?action=get_metadata&slug=wpkit-elementor',
	__FILE__,
	'wpkit-elementor'
);
