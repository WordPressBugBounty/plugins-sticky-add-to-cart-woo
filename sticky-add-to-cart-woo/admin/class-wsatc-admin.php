<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://solbox.dev/
 * @since      1.0.0
 *
 * @package    Wsatc
 * @subpackage Wsatc/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wsatc
 * @subpackage Wsatc/admin
 * @author     Solution Box
 */
class Wsatc_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The settings of this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $version    The current setting of this plugin.
	 */
	public $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$this->set_default_setting();
		$this->settings = $this->get_settings();

		require_once 'reports/class-wsatc-analytics.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $page ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wsatc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wsatc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( 'toplevel_page_wsatc' == $page || 'sticky-add-to-cart_page_wsatc-analytics' == $page || 'index.php' == $page ) {
			wp_enqueue_style( $this->plugin_name, WSATC_DIR_URL . 'assets/css/wsatc-admin.css', array( 'wp-color-picker' ), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $page ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wsatc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wsatc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( 'toplevel_page_wsatc' != $page ) {
			return;
		}
		wp_enqueue_script( $this->plugin_name . '-select2', WSATC_DIR_URL . '/admin/js/wsatc-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, WSATC_DIR_URL . '/assets/js/wsatc-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );
		wp_localize_script(
			$this->plugin_name,
			'WSATC',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	/**
	 * Admin menu
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function add_admin_menu() {
		// add_media_page( __( 'Stciky Add To Cart' ), __( 'Sticky Add To Cart' ), 'manage_options', 'woo-sticky-add-to-cart', array( $this, 'render_setting_page' ), 'dashicons-align-center' , 10 );
		$icon = 'data:image/svg+xml;base64,PHN2ZyBpZD0iQ2FwYV8xIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxsaW5lYXJHcmFkaWVudCBpZD0iU1ZHSURfMV8iIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB4MT0iMjU2IiB4Mj0iMjU2IiB5MT0iNTEyIiB5Mj0iMCI+PHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMDBiNTljIi8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjOWNmZmFjIi8+PC9saW5lYXJHcmFkaWVudD48Zz48Zz48cGF0aCBkPSJtNTA4Ljk5MyAxNTYuOTkxYy0yLjgzNC0zLjc3Mi03LjI3Ni01Ljk5MS0xMS45OTMtNS45OTFoLTkyLjA3NmMtNy4zMDEtNTAuODE2LTUxLjExOS05MC0xMDMuOTI0LTkwcy05Ni42MjMgMzkuMTg0LTEwMy45MjQgOTBoLTc4LjA1NGwtMTkuNi0xMzguMTA3Yy0xLjA0OS03LjM5Ni03LjM4MS0xMi44OTMtMTQuODUxLTEyLjg5M2gtNjkuNTcxYy04LjI4NCAwLTE1IDYuNzE2LTE1IDE1czYuNzE2IDE1IDE1IDE1aDU2LjU1Yy4wMTcuMTE5IDQxLjc1NSAyOTQuMTgzIDQyLjI0MSAyOTcuNjA2IDIuNDU4IDE3LjE5NyAxMC44MiAzMi45NzkgMjMuNTk5IDQ0LjY4NS0xMC4wMDQgOC4yNi0xNi4zOSAyMC43NTMtMTYuMzkgMzQuNzA5IDAgMjAuNzIzIDE0LjA4NCAzOC4yMDkgMzMuMTgxIDQzLjQxNC0yLjA0NSA1LjEzNy0zLjE4MSAxMC43My0zLjE4MSAxNi41ODYgMCAyNC44MTMgMjAuMTg3IDQ1IDQ1IDQ1czQ1LTIwLjE4NyA0NS00NWMwLTUuMjU4LS45MTUtMTAuMzA1LTIuNTgtMTUuMDFoMTI1LjE2Yy0xLjY2NSA0LjcwNS0yLjU4IDkuNzUxLTIuNTggMTUuMDEgMCAyNC44MTMgMjAuMTg3IDQ1IDQ1IDQ1czQ1LTIwLjE4NyA0NS00NS0yMC4xODctNDUtNDUtNDVoLTI0MGMtOC4yNzEgMC0xNS02LjcyOS0xNS0xNXM2LjcyOS0xNSAxNS0xNWgyMjQuNzQyYzMzLjMxIDAgNjIuOTY0LTIyLjM2OCA3Mi4wOTgtNTQuMzM5bDQ4LjU2Ni0xNjcuNDgzYzEuMzE1LTQuNTMxLjQyLTkuNDE2LTIuNDEzLTEzLjE4N3ptLTEwMi45OTMgMjk1LjAwOWM4LjI3MSAwIDE1IDYuNzI5IDE1IDE1cy02LjcyOSAxNS0xNSAxNS0xNS02LjcyOS0xNS0xNSA2LjcyOS0xNSAxNS0xNXptLTIxMCAwYzguMjcxIDAgMTUgNi43MjkgMTUgMTVzLTYuNzI5IDE1LTE1IDE1LTE1LTYuNzI5LTE1LTE1IDYuNzI5LTE1IDE1LTE1em0xMDUtMzYxYzQxLjM1NSAwIDc1IDMzLjY0NSA3NSA3NXMtMzMuNjQ1IDc1LTc1IDc1LTc1LTMzLjY0NS03NS03NSAzMy42NDUtNzUgNzUtNzV6bTEzMy4wMTEgMjM4LjM2M2MtNS40OSAxOS4yMTYtMjMuMjgzIDMyLjYzNy00My4yNjkgMzIuNjM3LTguNTY2IDAtMTkwLjM1MyAwLTIwMi43MDQgMC0yMi4yNSAwLTQxLjQwMS0xNi42MS00NC41NDYtMzguNjIzbC0yMC4yMTMtMTQyLjM3N2g3My43OTdjNy4zMDEgNTAuODE2IDUxLjExOSA5MCAxMDMuOTI0IDkwczk2LjYyMy0zOS4xODQgMTAzLjkyNC05MGg3Mi4xMDh6bS0xNjMuMDExLTE0OC4zNjNoMTV2MTVjMCA4LjI4NCA2LjcxNiAxNSAxNSAxNXMxNS02LjcxNiAxNS0xNXYtMTVoMTVjOC4yODQgMCAxNS02LjcxNiAxNS0xNXMtNi43MTYtMTUtMTUtMTVoLTE1di0xNWMwLTguMjg0LTYuNzE2LTE1LTE1LTE1cy0xNSA2LjcxNi0xNSAxNXYxNWgtMTVjLTguMjg0IDAtMTUgNi43MTYtMTUgMTVzNi43MTYgMTUgMTUgMTV6IiBmaWxsPSJ1cmwoI1NWR0lEXzFfKSIvPjwvZz48L2c+PC9zdmc+';
		add_menu_page(
			__( 'WooCommerce Sticky Add To Cart', 'woo-sticky-add-to-cart' ),
			__( 'Sticky Add To Cart', 'woo-sticky-add-to-cart' ),
			'manage_options',
			'wsatc',
			array( $this, 'render_setting_page' ),
			$icon,
			56
		);

		add_submenu_page(
			'wsatc',
			__( 'WooCommerce Sticky Add To Cart', 'woo-sticky-add-to-cart' ),
			__( 'Settings', 'woo-sticky-add-to-cart' ),
			'manage_options',
			'wsatc',
			array( $this, 'render_setting_page' )
		);

		add_submenu_page( 'wsatc', __( 'Analytics', 'woo-sticky-add-to-cart' ), __( 'Analytics', 'woo-sticky-add-to-cart' ), 'manage_options', 'wsatc-analytics', array( $this, 'render_analytics_page' ) );
	}

	/**
	 * Render setting page
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function render_setting_page() {
		printf( '<h1>%1$s</h1>', __( 'Simple Sticky Add To Cart For WooCommerce', 'woo-sticky-add-to-cart' ) );
		require_once 'partials/wsatc-admin-display.php';
	}

	/**
	 * Render setting page
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function render_analytics_page() {
		printf( '<h1 class="wstac-header">%1$s</h1>', __( 'Simple Sticky Add To Cart For WooCommerce', 'woo-sticky-add-to-cart' ) );
		$class = 'nx-header-for-admin';
		extract( $this->analytics_counter() );
		include_once 'partials/wsatc-admin-analytics-display.php';
	}

	/**
	 * Save back end setting
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function save_settings() {
		check_ajax_referer( 'wsatc-options-security', '_wpnonce' );

		$settings = array();

		// Visibilty settings.
		$settings['wsatc-enable']         = ( isset( $_POST['wsatc-enable'] ) && $_POST['wsatc-enable'] == 1 ) ? 1 : 0;
		$settings['wsatc-show-on-scroll'] = ( isset( $_POST['wsatc-show-on-scroll'] ) && $_POST['wsatc-show-on-scroll'] == 1 ) ? 1 : 0;
		$settings['enable-desktop']       = ( isset( $_POST['enable-desktop'] ) && $_POST['enable-desktop'] == 1 ) ? 1 : 0;
		$settings['enable-tablet']        = ( isset( $_POST['enable-tablet'] ) && $_POST['enable-tablet'] == 1 ) ? 1 : 0;
		$settings['enable-mobile']        = ( isset( $_POST['enable-mobile'] ) && $_POST['enable-mobile'] == 1 ) ? 1 : 0;

		// Design settings.
		$settings['sticky-background-color']   = isset( $_POST['sticky-background-color'] ) ? sanitize_text_field( $_POST['sticky-background-color'] ) : '';
		$settings['sticky-text-color']         = isset( $_POST['sticky-text-color'] ) ? sanitize_text_field( $_POST['sticky-text-color'] ) : '';
		$settings['sticky-stars-color']        = isset( $_POST['sticky-stars-color'] ) ? sanitize_text_field( $_POST['sticky-stars-color'] ) : '';
		$settings['sticky-rating-count-color'] = isset( $_POST['sticky-rating-count-color'] ) ? sanitize_text_field( $_POST['sticky-rating-count-color'] ) : '';

		$settings['cart-button-color']            = isset( $_POST['cart-button-color'] ) ? sanitize_text_field( $_POST['cart-button-color'] ) : '';
		$settings['cart-button-hover-color']      = isset( $_POST['cart-button-hover-color'] ) ? sanitize_text_field( $_POST['cart-button-hover-color'] ) : '';
		$settings['cart-button-text-color']       = isset( $_POST['cart-button-text-color'] ) ? sanitize_text_field( $_POST['cart-button-text-color'] ) : '';
		$settings['cart-button-hover-text-color'] = isset( $_POST['cart-button-hover-text-color'] ) ? sanitize_text_field( $_POST['cart-button-hover-text-color'] ) : '';
		$settings['sticky-stock-color']           = isset( $_POST['sticky-stock-color'] ) ? sanitize_text_field( $_POST['sticky-stock-color'] ) : '';

		// Configuration settings.
		$settings['sticky-bar-position']       = isset( $_POST['sticky-bar-position'] ) ? sanitize_text_field( $_POST['sticky-bar-position'] ) : 'bottom';
		$settings['wsatc-reviews']             = ( isset( $_POST['wsatc-reviews'] ) && $_POST['wsatc-reviews'] == 1 ) ? 1 : 0;
		$settings['wsatc-reviews-count']       = ( isset( $_POST['wsatc-reviews-count'] ) && $_POST['wsatc-reviews-count'] == 1 ) ? 1 : 0;
		$settings['wsatc-box-shadow']          = ( isset( $_POST['wsatc-box-shadow'] ) && $_POST['wsatc-box-shadow'] == 1 ) ? 1 : 0;
		$settings['wsatc-show-quantity']       = ( isset( $_POST['wsatc-show-quantity'] ) && $_POST['wsatc-show-quantity'] == 1 ) ? 1 : 0;
		$settings['wsatc-redirect']            = ( isset( $_POST['wsatc-redirect'] ) && $_POST['wsatc-redirect'] == 1 ) ? 1 : 0;
		$settings['wsatc-stock-count']         = ( isset( $_POST['wsatc-stock-count'] ) && $_POST['wsatc-stock-count'] == 1 ) ? 1 : 0;
		$settings['wsatc-show-image']          = ( isset( $_POST['wsatc-show-image'] ) && $_POST['wsatc-show-image'] == 1 ) ? 1 : 0;
		$settings['ajax-cart']                 = ( isset( $_POST['ajax-cart'] ) && $_POST['ajax-cart'] == 1 ) ? 1 : 0;
		$settings['wsatc-variable-price']      = ( isset( $_POST['wsatc-variable-price'] ) && $_POST['wsatc-variable-price'] == 1 ) ? 1 : 0;
		$settings['variable-button-behaviour'] = isset( $_POST['variable-button-behaviour'] ) ? sanitize_text_field( $_POST['variable-button-behaviour'] ) : '';
		$settings['wsatc-pixels-to-hide']      = isset( $_POST['wsatc-pixels-to-hide'] ) ? sanitize_text_field( $_POST['wsatc-pixels-to-hide'] ) : '';

		// Fonts settings.
		$settings['title-font-size']  = isset( $_POST['title-font-size'] ) ? sanitize_text_field( $_POST['title-font-size'] ) : '';
		$settings['button-font-size'] = isset( $_POST['button-font-size'] ) ? sanitize_text_field( $_POST['button-font-size'] ) : '';
		$settings['price-font-size']  = isset( $_POST['price-font-size'] ) ? sanitize_text_field( $_POST['price-font-size'] ) : '';
		$settings['sale-font-size']   = isset( $_POST['sale-font-size'] ) ? sanitize_text_field( $_POST['sale-font-size'] ) : '';
		$settings['stock-font-size']  = isset( $_POST['stock-font-size'] ) ? sanitize_text_field( $_POST['stock-font-size'] ) : '';
		$settings['review-font-size'] = isset( $_POST['review-font-size'] ) ? sanitize_text_field( $_POST['review-font-size'] ) : '';

		$settings = apply_filters( 'wsatc_before_setting_saved', $settings );

		update_option( 'wsatc_options', $settings );
		wp_send_json(
			array(
				'success' => true,
				'data'    => $_POST,
			)
		);
	}

	/**
	 *  Default settings of the plguin
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function get_default_settings() {
		$setting = array();

		// Visibilty settings.
		$setting['wsatc-enable']         = 1;
		$setting['wsatc-show-on-scroll'] = 0;
		$setting['enable-desktop']       = 1;
		$setting['enable-tablet']        = 1;
		$setting['enable-mobile']        = 1;

		// Design settings.
		$setting ['sticky-stars-color']        = '#000';
		$setting ['sticky-rating-count-color'] = '#000';
		$setting ['sticky-stock-color']        = '#000';
		$setting ['sticky-out-stock-color']    = '#dd3333';

		// Configuration settings.
		$setting['wsatc-reviews']             = 1;
		$setting['wsatc-reviews-count']       = 1;
		$setting['wsatc-box-shadow']          = 1;
		$setting['wsatc-show-quantity']       = 1;
		$setting['wsatc-redirect']            = 0; // NEW CODE
		$setting['wsatc-stock-count']         = 1;
		$setting['wsatc-show-image']          = 1;
		$setting['wsatc-variable-price']      = 1;
		$setting['wsatc-pixels-to-hide']      = '';
		$setting['sticky-bar-position']       = 'bottom';
		$setting['variable-button-behaviour'] = 'regular';
		return $setting;
	}

	/**
	 * Set defulat setting
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function set_default_setting() {
		if ( ! get_option( 'wsatc_options' ) ) {
			update_option( 'wsatc_options', $this->get_default_settings() );
		}
	}

	/**
	 * Get setting
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function get_settings() {
		return get_option( 'wsatc_options' );
	}

	/**
	 * Reset Default settings
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function reset_settings() {

		$default_settings = $this->get_default_settings();
		update_option( 'wsatc_options', $default_settings );
		wp_send_json(
			array(
				'success' => true,
				'data'    => $default_settings,
			)
		);
	}

	/**
	 * Helper function to get setting.
	 *
	 * @param array   $setting all save setting.
	 * @param boolean $default value of the.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return mixed
	 */
	public function wsatc_get_setting( $setting, $default = false ) {

		if ( isset( $this->settings[ $setting ] ) ) {
			return $this->settings[ $setting ];
		} else {
			return $default;
		}
	}

	/**
	 * Check is pro installed.
	 *
	 * @since 1.0.0
	 * @return boolean
	 */
	public function is_pro_installed(): boolean {
		return class_exists( 'Wsatc_Pro' );
	}

	/**
	 * Pro setting badge
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function is_pro_setting() {
		if ( ! class_exists( 'Wsatc_Pro' ) ) {
				printf( "<a class='pro-badge' href='" . WSATC_PRO_LINK . "'>%s</a>", __( 'Pro Feature', 'woo-sticky-add-to-cart' ) );
		}
	}

	/**
	 * Pro setting class.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function is_pro_class() {
		if ( ! class_exists( 'Wsatc_Pro' ) ) {
				echo 'pro_setting';
		}
	}

	public function wc_product_dropdown_categories( $args = array(), $deprecated_hierarchical = 1, $deprecated_show_uncategorized = 1, $deprecated_orderby = '' ) {
		global $wp_query;

		if ( ! is_array( $args ) ) {
				wc_deprecated_argument( 'wc_product_dropdown_categories()', '2.1', 'show_counts, hierarchical, show_uncategorized and orderby arguments are invalid - pass a single array of values instead.' );

				$args['show_count']         = $args;
				$args['hierarchical']       = $deprecated_hierarchical;
				$args['show_uncategorized'] = $deprecated_show_uncategorized;
				$args['orderby']            = $deprecated_orderby;
		}

		// $current_product_cat = isset( $wp_query->query_vars['product_cat'] ) ? $wp_query->query_vars['product_cat'] : '';
		$current_product_cat = wsatc_get_setting( 'wsatc-hide-product-cat' );
		$defaults            = array(
			'pad_counts'         => 1,
			'show_count'         => 1,
			'hierarchical'       => 1,
			'hide_empty'         => 1,
			'show_uncategorized' => 1,
			'orderby'            => 'name',
			'selected'           => $current_product_cat,
			'menu_order'         => false,
		);

		$args = wp_parse_args( $args, $defaults );

		if ( 'order' === $args['orderby'] ) {
				$args['menu_order'] = 'asc';
				$args['orderby']    = 'name';
		}

		$terms = get_terms( 'product_cat', apply_filters( 'wc_product_dropdown_categories_get_terms_args', $args ) );

		if ( empty( $terms ) ) {
				return;
		}

		$output  = "<select name='wsatc-hide-product-cat[]' class='dropdown_product_cat' multiple>";
		$output .= '<option value="" ' . selected( $current_product_cat, '', false ) . '>' . esc_html__( 'Select a category', 'woo-sticky-add-to-cart' ) . '</option>';
		$output .= wc_walk_category_dropdown_tree( $terms, 0, $args );
		if ( $args['show_uncategorized'] ) {
				$output .= '<option value="0" ' . selected( $current_product_cat, '0', false ) . '>' . esc_html__( 'Uncategorized', 'woo-sticky-add-to-cart' ) . '</option>';
		}
		$output .= '</select>';

		echo $output;
	}

	/**
	 * Modify plugin action link.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $links plugin action links.
	 * @param string $file activation path.
	 *
	 * @return array $links  action links.
	 */
	public function action_links( $links, $file ) {

		if ( $file == wsatc_activate_path() ) {
			$settings_link = sprintf( '%1$s Settings %2$s ', '<a href="' . admin_url( 'admin.php?page=woo-sticky-add-to-cart' ) . '">', '</a>' );
			array_unshift( $links, $settings_link );
			if ( ! wsatc_is_pro() ) :
				$pro_link = sprintf( esc_html__( '%1$s %3$s Go Pro %4$s %2$s', 'woo-sticky-add-to-cart' ), '<a style="color:#39b54a;font-weight: 700;" href="' . WSATC_PRO_LINK . '" target="_blank">', '</a>', '<span class="wsatc-dasboard-pro-link">', '</span>' );
				array_push( $links, $pro_link );
			endif;
		}

		return $links;
	}

	/**
	 * Meta links for plugin.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $meta_fields meta fields.
	 * @param string $file plugin activation path.
	 *
	 * @return array $meta_fields meta fields.
	 */
	public function plugin_row_meta( $meta_fields, $file ) {

		if ( $file != wsatc_activate_path() ) {

			return $meta_fields;
		}

		echo '<style>.wsatc-rate-stars { display: inline-block; color: #ffb900; position: relative; top: 3px; }.wsatc-rate-stars svg{ fill:#ffb900; } .wsatc-rate-stars svg:hover{ fill:#ffb900 } .wsatc-rate-stars svg:hover ~ svg{ fill:none; } </style>';

		$plugin_rate   = 'https://wordpress.org/support/plugin/sticky-add-to-cart-woo/reviews/?rate=5#new-post';
		$plugin_filter = 'https://wordpress.org/support/plugin/sticky-add-to-cart-woo/reviews/?filter=5';
		$svg_xmlns     = 'https://www.w3.org/2000/svg';
		$svg_icon      = '';

		for ( $i = 0; $i < 5; $i++ ) {
			$svg_icon .= "<svg xmlns='" . esc_url( $svg_xmlns ) . "' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>";
		}

		$meta_fields[] = '<a href="' . esc_url( $plugin_filter ) . '" target="_blank"><span class="dashicons dashicons-thumbs-up"></span>' . __( 'Vote!', 'wsatc' ) . '</a>';

		$meta_fields[] = "<a href='" . esc_url( $plugin_rate ) . "' target='_blank' title='" . esc_html__( 'Rate', 'wsatc' ) . "'><i class='wsatc-rate-stars'>" . $svg_icon . '</i></a>';

		return $meta_fields;
	}


	/**
	 * Deactivation feedback form.
	 *
	 * @since 1.1.1
	 * @param array $plugins plugins.
	 * @return array $plugins plugins.
	 */
	public function deactivate_feedback_form( $plugins ) {
		$plugins[] = (object) array(
			'slug'    => 'sticky-add-to-cart-woo',
			'version' => WSATC_VERSION,
		);
		return $plugins;
	}


	/**
	 * Submission deactivation feedback.
	 *
	 * @since 1.1.1
	 * @return void
	 */
	public function deactivation_feedback() {

		check_ajax_referer( 'wsatc-deactivate-nonce', 'security' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Jack ;@123#1...' );
		}

		$_data         = json_decode( wp_unslash( $_POST['plugin'] ), true );
		$email         = get_option( 'admin_email' );
		$reason        = sanitize_text_field( wp_unslash( $_data['reasons'][ $_POST['reason'] ] ) );
		$reason_detail = '';

		if ( 'other' == $_POST['reason'] ) {
			$reason_detail = sanitize_text_field( wp_unslash( $_POST['comments'] ) );
		}

		if ( 'found-better-plugin' == $_POST['reason'] ) {
			$reason_detail = sanitize_text_field( wp_unslash( $_POST['plugin-name'] ) );
		}

		$fields = array(
			'email'             => $email,
			'website'           => get_site_url(),
			'action'            => 'deactivate',
			'reason'            => $reason,
			'reason_detail'     => $reason_detail,
			'blog_language'     => get_bloginfo( 'language' ),
			'wordpress_version' => get_bloginfo( 'version' ),
			'php_version'       => PHP_VERSION,
			'plugin_version'    => WSATC_VERSION,
			'plugin_name'       => 'Wsatc Free',
		);

		$response = wp_remote_post(
			'https://solbox.dev/',
			array(
				'method'      => 'POST',
				'timeout'     => 5,
				'httpversion' => '1.0',
				'blocking'    => false,
				'headers'     => array(),
				'body'        => $fields,
			)
		);

		wp_die();
	}

	/**
	 * Admin dashboard widget.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	public function admin_home_widget() {
		wp_add_dashboard_widget( 'dashboard_widget', __( 'Simple Sticky Add to Cart Analytics', 'wsatc' ), array( $this, 'stats_counter' ) );
	}

	/**
	 * Analytics counter.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	public function analytics_counter() {
		global $pagenow, $current_user, $wpdb;
		$ids = false;

		$inner_sql = "SELECT DISTINCT INNER_POSTS.ID, INNER_POSTS.post_title FROM $wpdb->posts AS INNER_POSTS INNER JOIN $wpdb->postmeta AS INNER_META ON INNER_POSTS.ID = INNER_META.post_id WHERE INNER_POSTS.post_type = '%s'";

		$query = $wpdb->prepare(
			"SELECT META.meta_key as `key`, SUM( META.meta_value ) as `value` FROM ( $inner_sql ) as POSTS INNER JOIN $wpdb->postmeta as META ON POSTS.ID = META.post_id WHERE META.meta_key IN ( '_sc_meta_views', '_sc_meta_clicks' ) GROUP BY META.meta_key",
			array(
				'product',
			)
		);

		$results = $wpdb->get_results( $query );

		$views = $clicks = $ctr = 0;

		if ( ! empty( $results ) ) {
			foreach ( $results as $result ) {
				if ( isset( $result->key ) && $result->key === '_sc_meta_views' ) {
						$views = $result->value;
				}
				if ( isset( $result->key ) && $result->key === '_sc_meta_clicks' ) {
						$clicks = $result->value;
				}
			}
		}

		$ctr = $views > 0 ? number_format( ( intval( $clicks ) / intval( $views ) ) * 100, 2 ) : 0;

		$views  = wsatc_nice_number( $views );
		$clicks = wsatc_nice_number( $clicks );

		$views_link  = admin_url( 'admin.php?page=wsatc-analytics&comparison_factor=views' );
		$clicks_link = admin_url( 'admin.php?page=wsatc-analytics&comparison_factor=clicks' );
		$ctr_link    = admin_url( 'admin.php?page=wsatc-analytics&comparison_factor=ctr' );

		return array(
			'views_link'  => $views_link,
			'clicks_link' => $clicks_link,
			'ctr_link'    => $ctr_link,
			'views'       => $views,
			'clicks'      => $clicks,
			'ctr'         => $ctr,
		);
	}

	public function stats_counter() {
		extract( $this->analytics_counter() );
		return include_once 'partials/wsatc-admin-analytics-counter.php';
	}

	/**
	 * Black friday discount notice.
	 */
	public function black_friday_notice() {

		if ( isset( $_GET['bfn_dismiss'] ) && isset( $_GET['_wpnonce'] ) ) {
			if ( wp_verify_nonce( $_GET['_wpnonce'], 'bfn_dismiss' ) ) {
				update_option( 'wsatc_bfn_dismiss', true );
			}
		}

		$already_done    = get_option( 'wsatc_bfn_dismiss' );
		$dismiss_bfn_url = add_query_arg(
			array(
				'bfn_dismiss' => '1',
				'_wpnonce'    => wp_create_nonce( 'bfn_dismiss' ),
			),
			get_admin_url()
		);

		if ( ! wsatc_is_black_friday() || $already_done ) {
			return;
		}

		echo "<div class='notice notice-info'>
			<p><strong>Simple Sticky Add To Cart For WooCommerce </strong> represent <strong>Black Friday & Cyber Monday</strong>🔥 MASSIVE savings -30% OFF on all plans. Use 
			<a target='_blank' href='https://solbox.dev/plugins/sticky-cart/?utm_source=notice&utm_medium=free_plugin&utm_campaign=bf_discount' class='button button-primary'>BLACK_FRIDAY_30</a> coupon code. <br> 💪 Limited time - once it goes away, it's gone! <a href='" . $dismiss_bfn_url . "' class='void-grid-review-done'>  Already Done !</a></p> 
 		</div>";
	}

	/**
	 * Black friday discount notice.
	 */
	public function ask_review_notice() {

		if ( isset( $_GET['arn_dismiss'] ) && isset( $_GET['_wpnonce'] ) ) {
			if ( wp_verify_nonce( $_GET['_wpnonce'], 'arn_dismiss' ) ) {
				update_option( 'wsatc_arn_dismiss', true );
			}
		}

		$already_done    = get_option( 'wsatc_arn_dismiss' );
		$dismiss_bfn_url = add_query_arg(
			array(
				'arn_dismiss' => '1',
				'_wpnonce'    => wp_create_nonce( 'arn_dismiss' ),
			),
			get_admin_url()
		);

		if ( $already_done ) {
			return;
		}

		echo "<div class='notice notice-info'>
			<p><strong>Simple Sticky Add To Cart For WooCommerce </strong> represent <strong>Give way</strong>🔥 1 site Pro license - Give us a review on  
			<a target='_blank' href='https://wordpress.org/support/plugin/sticky-add-to-cart-woo/reviews/#new-post' class='button button-primary'>wordpress.org</a> and get free pro license. <br> 💪 Limited time - once you complete it send us a proof on solutionboxdev@gmail.com
			<a href='" . $dismiss_bfn_url . "' class='void-grid-review-done'>  Already Done !</a></p> 
 		</div>";
	}
}
