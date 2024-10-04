<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://solbox.dev/
 * @since      1.0.0
 *
 * @package    Wsatc
 * @subpackage Wsatc/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wsatc
 * @subpackage Wsatc/includes
 * @author     Solution Box <solutionboxdev@gmail.com>
 */
class Wsatc {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wsatc_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WSATC_VERSION' ) ) {
			$this->version = WSATC_VERSION;
		} else {
			$this->version = '1.2.1';
		}
		$this->plugin_name = 'woo-sticky-add-to-cart';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_common_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wsatc_Loader. Orchestrates the hooks of the plugin.
	 * - Wsatc_i18n. Defines internationalization functionality.
	 * - Wsatc_Admin. Defines all hooks for the admin area.
	 * - Wsatc_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Helper function for plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/helper.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wsatc-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wsatc-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'admin/class-wsatc-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'public/class-wsatc-public.php';

		/**
		 * Helper function for plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'lib/solbox-plugin-deactivation-survey/deactivate-feedback-form.php';

		do_action( 'wsatc_load_dependencies' );
		$this->loader = new Wsatc_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wsatc_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wsatc_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wsatc_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_menu' );
		$this->loader->add_action( 'wp_ajax_wsatc_save_settings', $plugin_admin, 'save_settings' );
		$this->loader->add_action( 'wp_ajax_wsatc_reset_settings', $plugin_admin, 'reset_settings' );
		$this->loader->add_action( 'plugin_action_links', $plugin_admin, 'action_links', 10, 2 );
		$this->loader->add_action( 'wp_ajax_wsatc_deactivation_feedback', $plugin_admin, 'deactivation_feedback' );
		$this->loader->add_action( 'wp_dashboard_setup', $plugin_admin, 'admin_home_widget' );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'black_friday_notice' );
		// $this->loader->add_action( 'admin_notices', $plugin_admin, 'ask_review_notice' );

		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'plugin_row_meta', 10, 2 );
		$this->loader->add_filter( 'solbox_deactivate_feedback_form_plugins', $plugin_admin, 'deactivate_feedback_form', 10, 2 );
		$this->loader->add_filter( 'wsatc_after_analytics_header', $plugin_admin, 'stats_counter', 10, 2 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wsatc_Public( $this->get_plugin_name(), $this->get_version() );

		/**
		* Load WooCommerce compatibility file.
		*/
		if ( wsatc_is_woo() ) {

			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
			$this->loader->add_action( 'wp_footer', $plugin_public, 'add_sticky_add_to_cart' );
			$this->loader->add_action( 'wp_head', $plugin_public, 'add_custom_css' );
		}
	}

	/**
	 * Register all of the hooks related to the both public/admin-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_common_hooks() {
		$this->loader->add_action( 'wp_ajax_wsatc_add_cart_single', $this, 'wsatc_add_cart_single' );
		$this->loader->add_action( 'wp_ajax_nopriv_wsatc_add_cart_single', $this, 'wsatc_add_cart_single' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wsatc_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Single Product custom add to cart function.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function wsatc_add_cart_single() {
		$product_id   = (int) $_POST['product_id'];
		$variation_id = isset( $_POST['variation_id'] ) ? (int) $_POST['variation_id'] : '';
		$quantity     = (int) $_POST['quantity'];

		if ( '' !== $variation_id ) {
			WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
		} else {
			WC()->cart->add_to_cart( $product_id, $quantity );
		}
		$items = WC()->cart->get_cart();
		global $woocommerce;
		$item_count = $woocommerce->cart->cart_contents_count;

		WC_AJAX::get_refreshed_fragments();
		wp_die();
	}
}
