<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://solbox.dev/
 * @since      1.0.0
 *
 * @package    Wsatc
 * @subpackage Wsatc/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wsatc
 * @subpackage Wsatc/public
 * @author     Solution Box <solutionboxdev@gmail.com>
 */
class Wsatc_Public {

	/**
	 * The ID of this plugin
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
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$this->settings = $this->get_settings();
		add_filter( 'wsatc_product_hide', array( $this, 'hide_sticky_atc' ), 10, 2 );
	}

	/**
	 * Hide WSATC on products.
	 *
	 * @since 1.3.0
	 *
	 * @param boolean $hide  wanna hide on product.
	 * @param int     $product_id current product id.
	 *
	 * @return boolean $hide
	 */
	function hide_sticky_atc( $hide, $product_id ) {
		$product = wc_get_product( $product_id );
		$type    = $product->get_type();
		if ( 'grouped' == $type ) {
			$hide = true;
		}

		return $hide;
	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		if ( ! is_singular( 'product' ) ) {
			return;
		}
		wp_register_style( $this->plugin_name, WSATC_DIR_URL . 'assets/css/wsatc-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		if ( ! is_singular( 'product' ) ) {
			return;
		}
		wp_register_script( $this->plugin_name, WSATC_DIR_URL . 'assets/js/wsatc-public.js', array( 'jquery', 'wp-hooks' ), $this->version, false );

		wp_localize_script(
			$this->plugin_name,
			'WSATC',
			array(
				'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
				'showOnScroll'     => $this->settings['wsatc-show-on-scroll'],
				'scrollPixelsHide' => $this->settings['wsatc-pixels-to-hide'],
				'barPosition'      => $this->settings['sticky-bar-position'],
				'isPro'            => wsatc_is_pro(),
				'nonce'            => wp_create_nonce( 'wsatc_nonce' ),
				'isAdmin'          => current_user_can( 'administrator' ),
			)
		);
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
	 * Main method to show sticky cart.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function add_sticky_add_to_cart() {
		if ( ! is_singular( 'product' ) ) {
			return;
		}
		global $product;
		$product_id         = $product->get_id();
		$settings           = $this->settings;
		$wsatc_product_hide = apply_filters( 'wsatc_product_hide', false, $product_id );
		if ( $settings['wsatc-enable'] && is_product() && ! $wsatc_product_hide ) {

			wp_enqueue_style( $this->plugin_name );
			wp_enqueue_script( $this->plugin_name );
			$review_count           = $product->get_rating_count();
			$reviews_enabled        = $settings['wsatc-reviews'];
			$stock_enabled          = $settings['wsatc-stock-count'];
			$sticky_position        = $settings['sticky-bar-position'];
			$scroll_pixels_hide     = $settings['wsatc-pixels-to-hide'];
			$reviews_counts_enabled = $settings['wsatc-reviews-count'];
			$cart_url               = apply_filters( 'wsatc_url', "?add-to-cart=$product_id&quantity=1", $product_id );
			$add_to_cart_text       = '';
			$product_type           = '';
			if ( $product->is_type( 'variable' ) ) {
				$add_to_cart_text = __( 'Select Options', 'woo-sticky-add-to-cart' );
				$product_type     = 'variable';
			} elseif ( $product->is_type( 'external' ) ) {
				$add_to_cart_text = __( 'Add to Cart', 'woo-add-to-cart' );
				$product_type     = 'external';
			} else {
				$add_to_cart_text = __( 'Add to Cart', 'woo-add-to-cart' );
				$product_type     = 'simple';
			}

			/**
			 * Filter to modify add to cart text.
			 *
			 * @since 1.0.0
			 *
			 * @param string $add_to_cart_text button text.
			 * @param string $product_type product type.
			 * @param integer $product_id product id.
			 */
			$add_to_cart_text = apply_filters( 'wsatc_button_text', $add_to_cart_text, $product_type, $product_id );

			$stock = '';
			if ( $product->managing_stock() && ! $product->is_in_stock() ) {
				$stock = __( 'Out of stock', 'woo-sticky-add-to-cart' );
			} elseif ( $product->managing_stock() == true ) {

				$stock = $product->get_stock_quantity() . __( ' in stock', 'woo-sticky-add-to-cart' );
			}

			$device_off = '';

			if ( ! $settings['enable-desktop'] ) {
				$device_off = ' disable-desktop ';
			}
			if ( ! $settings['enable-tablet'] ) {
				$device_off .= ' disable-tablet ';
			}
			if ( ! $settings['enable-mobile'] ) {
				$device_off .= ' disable-mobile ';
			}

			$extra_classes = $product_type . ' ' . $device_off . ' ' . 'wsatc-' . $settings['sticky-bar-position'];

			if ( ! $scroll_pixels_hide && 'bottom' == $sticky_position ) {
				$extra_classes .= ' active';
			}
			$extra_classes     = apply_filters( 'wsatc_wrapper_classes', $extra_classes );
			$cart_button_class = apply_filters( 'wsatc_cart_button_class', '' );

			?>

<div id="wsatc-stick-cart-wrapper" class="wsatc-stick-cart-wrapper <?php echo $extra_classes; ?>">
	<div class="wsatc-container" data-product-id="<?php echo (int) $product_id; ?>">
		<div class="wrap-product-content">
			<div class="wsatc-product-img"> <?php echo $product->get_image(); ?> </div>
			<div class="wsatc-title-rating">
				<div class="product-title"><?php echo esc_html( $product->get_title() ); ?></div>
				<?php if ( $review_count && $reviews_enabled ) : ?>
				<div class="wsatc-rating"> <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
					<?php if ( $reviews_counts_enabled ) : ?>
						<span class="wsatc-rating-count">(<?php echo $review_count; ?>)</span>
					<?php endif; ?>
				</div>
				<?php endif; // Review Count. ?>
			</div>
			<div class="wsatc-price-stock">
				<?php do_action( 'wsatc_before_price', $product ); ?>
				<div class="wsatc-price"><?php echo $product->get_price_html(); ?></div>
				<?php do_action( 'wsatc_after_price', $product ); ?>
				<?php if ( $stock_enabled ) : ?>
					<div class="wsatc-stock"><?php echo $stock; ?></div>
				<?php endif; ?>
			</div>
		</div>
	
		<div class="wsatc-right-section">
			<?php do_action( 'wsatc_start_atc' ); ?>
				<div class="wsatc-qty-wrapper">
					<div class="wsatc-qty-minus" > - </div>
						<input type="number" step="1" min="1" value="1" name="quantity" class="wsatc-qty-field">
					<div class="wsatc-qty-plus" > + </div>
				</div>
			<a href="<?php echo esc_url( $cart_url ); ?>" class="wsatc-add-to-cart <?php echo esc_attr( $cart_button_class ); ?>" title="<?php esc_html_e( $add_to_cart_text ); ?>"><?php esc_html_e( $add_to_cart_text ); ?> <span class="loader"></span></a>
		</div>
	</div>
</div>

			<?php
		}
	}

	/**
	 * Custom css for sticky add to cart
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function add_custom_css() {
		if ( is_product() ) {
			require_once 'partials/wsatc-custom-css.php';
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
}
