<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeluxury.com
 * @since             1.0.0
 * @package           TL_Coming_Soon
 *
 * @wordpress-plugin
 * Plugin Name:       TL Coming Soon
 * Plugin URI:        https://wordpress.org/plugins/tl-coming-soon/
 * Description:       Coming Soon, Maintenance Mode and Under Construction plugin for WordPress.
 * Version:           1.0.0
 * Author:            ThemeLuxury
 * Author URI:        https://themeluxury.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tl-coming-soon
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'TL_COMING_SOON_VERSION', '1.0.0' );
define('TL_COMING_SOON_DIR', trailingslashit(plugin_dir_path(__FILE__)));
define('TL_COMING_SOON_URL', trailingslashit(plugin_dir_url(__FILE__)));
define('TL_COMING_SOON_VIEWS', TL_COMING_SOON_DIR . trailingslashit('public'));
define('TL_COMING_SOON_VIEWS_URL', TL_COMING_SOON_URL . trailingslashit('public'));
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tl-coming-soon-activator.php
 */
function activate_tl_coming_soon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tl-coming-soon-activator.php';
	TL_Coming_Soon_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tl-coming-soon-deactivator.php
 */
function deactivate_tl_coming_soon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tl-coming-soon-deactivator.php';
	TL_Coming_Soon_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tl_coming_soon' );
register_deactivation_hook( __FILE__, 'deactivate_tl_coming_soon' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tl-coming-soon.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tl_coming_soon() {

	$plugin = new TL_Coming_Soon();
	$plugin->run();

}
run_tl_coming_soon();
