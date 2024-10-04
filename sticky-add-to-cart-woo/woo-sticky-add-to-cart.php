<?php
/**
 * Plugin Name: Simple Sticky Add To Cart For WooCommerce
 * Plugin URI: https://solbox.dev/plugins/sticky-cart/?utm_source=freemium&utm_medium=author-uri&utm_campaign=go_pro
 * Description: Simple Sticky Add To Cart For WooCommerce use to show sticky add to cart on product page. Its helps to grab more sale rather than boring WooCommerce add to cart button. It support ajax add to cart, color customization according to theme, variable product sticky cart and much more.
 * Version: 1.4.4
 * Author: Solution Box
 * Author URI: https://solbox.dev/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: woo-sticky-add-to-cart
 * Domain Path: /languages
 * WC requires at least: 5.0
 * WC tested up to: 8.8.3
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WSATC_VERSION', '1.4.3' );
define( 'WSATC_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WSATC_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'WSATC_PRO_LINK', 'https://solbox.dev/plugins/sticky-cart/?utm_source=freemium&utm_medium=dashbaord&utm_campaign=go_pro' );
define( 'WSATC_BLACK_FRIDAY', '2023-12-05' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wsatc-activator.php
 */
function activate_wsatc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wsatc-activator.php';
	Wsatc_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wsatc-deactivator.php
 */
function deactivate_wsatc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wsatc-deactivator.php';
	Wsatc_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wsatc' );
register_deactivation_hook( __FILE__, 'deactivate_wsatc' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wsatc.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wsatc() {

	$plugin = new Wsatc();
	$plugin->run();
}


add_action( 'plugins_loaded', 'wsatc_run' );
add_action( 'before_woocommerce_init', 'hpos_compt' );

/**
 * HPOS Compatibility.
 */
function hpos_compt() {
	if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	}
}
/**
 * Load the plugin.
 *
 * @since 1.0.0
 * @return void
 */
function wsatc_run() {
	if ( class_exists( 'WooCommerce' ) ) {
		run_wsatc();
	} else {
		require plugin_dir_path( __FILE__ ) . 'includes/helper.php';
		add_action( 'admin_notices', 'wsatc_woo_require_notice' );
	}
}
