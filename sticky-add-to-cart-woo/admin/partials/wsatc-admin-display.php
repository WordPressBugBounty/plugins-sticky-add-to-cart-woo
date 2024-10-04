<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://solbox.dev/
 * @since      1.0.0
 *
 * @package    Wsatc
 * @subpackage Wsatc/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php do_action( 'wsatc_before_start_wrapper' ); ?>
<div class="wsatc-settings-wrapper">
	<?php do_action( 'wsatc_start_setting_wrapper' ); ?>
	<?php require_once 'wsatc-setting-tabs.php'; ?>

	<div class="tabs-content-wrapper">
		<div id="snackbar"><?php echo __( 'Setting successfully saved' ); ?></div>
		<?php do_action( 'wsatc_tab_content_start' ); ?>
		<form id="wsatc-settings" name="wsatc-settings">
			<div class="loader-containter">
				<div class="loader"></div>
			</div>
			<?php do_action( 'wsatc_setting_form_start' ); ?>
			<?php wp_nonce_field( 'wsatc-options-security' ); ?>
			<div class="visibility wsatc-tab-content active">
				<h3><?php esc_html_e( 'Visibility Settings', 'woo-sticky-add-to-cart' ); ?></h3>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Activation', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Enable or Disable simple sticky cart', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-enable" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-enable' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Show after Scroll', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Either you want show after scroll or always', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-show-on-scroll" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-show-on-scroll' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Enable On Desktop', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Enable or Disable on Desktop', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name='enable-desktop' value="1"
								<?php checked( $this->wsatc_get_setting( 'enable-desktop' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
						<br>
						<small><?php esc_html_e( 'All devices have width greater than 1024px', 'woo-sticky-add-to-cart' ); ?></small>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Enable On Tablet', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Enable or Disable on Tablet', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="enable-tablet" value="1"
								<?php checked( $this->wsatc_get_setting( 'enable-tablet' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
						<br>
						<small><?php esc_html_e( 'All devices have width between 600px - 1024px', 'woo-sticky-add-to-cart' ); ?></small>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Enable on Mobile', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Enable or Disable on Mobile', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="enable-mobile" value="1"
								<?php checked( $this->wsatc_get_setting( 'enable-mobile' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
						<br>
						<small><?php esc_html_e( 'All devices have width less than 600px', 'woo-sticky-add-to-cart' ); ?></small>
					</div>
				</div>
			</div>
			<!--Visibilty tab end-->
			<div class="wsatc-tab-content design">
				<h3><?php esc_html_e( 'Design Settings', 'woo-sticky-add-to-cart' ); ?></h3>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Background Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Background color of sticky bar.', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-background-color', '#fdfdfd' ) ); ?>"
							class="wsatc-color-field" name="sticky-background-color" data-default-color="#fdfdfd" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper  <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Box Shadow Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Sticky bar shadow color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-shadow-color', '' ) ); ?>"
							class="wsatc-color-field" name="sticky-shadow-color" data-default-color="" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Text Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Text color in sticky bar', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-text-color', '#000' ) ); ?>"
							class="wsatc-color-field" name="sticky-text-color" data-default-color="#000" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper  <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Product Title Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Product title color in sticky', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-title-color', '#000' ) ); ?>"
							class="wsatc-color-field" name="sticky-title-color" data-default-color="#000" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper  <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Price Text Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Product price text color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-price-color', '#000' ) ); ?>"
							class="wsatc-color-field" name="sticky-price-color" data-default-color="#000" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper  <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Price Badge Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Product price badge color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_attr_e( $this->wsatc_get_setting( 'wsatc-price-badge-color', '' ) ); ?>"
							class="wsatc-color-field" name="wsatc-price-badge-color" data-default-color="" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper  <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Sale Text Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'sale text color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_attr_e( $this->wsatc_get_setting( 'wsatc-sale-color', '' ) ); ?>"
							class="wsatc-color-field" name="wsatc-sale-color" data-default-color="" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper  <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Sale Badge Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Sale badge color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_attr_e( $this->wsatc_get_setting( 'wsatc-sale-badge-color', '' ) ); ?>"
							class="wsatc-color-field" name="wsatc-sale-badge-color" data-default-color="" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Review Stars Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'rating stars color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-stars-color', '#000' ) ); ?>"
							class="wsatc-color-field" name="sticky-stars-color" data-default-color="#000" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper  <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper">
						<?php esc_html_e( 'Review Stars Outline Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'rating stars outline color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-stars-outline-color', '' ) ); ?>"
							class="wsatc-color-field" name="sticky-stars-outline-color" data-default-color="" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Reviews Count Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'review count text color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-rating-count-color', '#000' ) ); ?>"
							class="wsatc-color-field" name="sticky-rating-count-color" data-default-color="#000" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Button Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Add to cart button color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_attr_e( $this->wsatc_get_setting( 'cart-button-color', '#282828' ) ); ?>"
							class="wsatc-color-field" name="cart-button-color" data-default-color="#282828" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Button Hover Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Add to cart button hover color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_attr_e( $this->wsatc_get_setting( 'cart-button-hover-color', '#4e4e4e' ) ); ?>"
							class="wsatc-color-field" name="cart-button-hover-color" data-default-color="#4e4e4e" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Button Text Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Add to cart button text color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_attr_e( $this->wsatc_get_setting( 'cart-button-text-color', '#ffffff' ) ); ?>"
							class="wsatc-color-field" name="cart-button-text-color" data-default-color="#ffffff" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Button Hover Text Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Add to cart button text hover color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_attr_e( $this->wsatc_get_setting( 'cart-button-hover-text-color', '#ffffff' ) ); ?>"
							class="wsatc-color-field" name="cart-button-hover-text-color" data-default-color="#ffffff" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Stock Text Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'In Stock Text Color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-stock-color', '#000' ) ); ?>"
							class="wsatc-color-field" name="sticky-stock-color" data-default-color="#000" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Out Stock Text Color', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Out Stock Text Color', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div> <?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_attr_e( $this->wsatc_get_setting( 'sticky-out-stock-color', '#dd3333' ) ); ?>"
							class="wsatc-color-field" name="sticky-out-stock-color" data-default-color="#dd3333" />
					</div>
				</div>
			</div>
			<!--Design tab end-->
			<div class="wsatc-tab-content configuration">
				<h3><?php esc_html_e( 'Configuration Settings', 'woo-sticky-add-to-cart' ); ?></h3>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper">
						<?php esc_html_e( 'Simple Product Button Text', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Add to cart button text ', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_html_e( $this->wsatc_get_setting( 'simple-product-button-text', 'Add to Cart' ) ); ?>"
							name="simple-product-button-text" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper">
						<?php esc_html_e( 'Variable Product Button Text', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Add to cart button text for variable product.', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_html_e( $this->wsatc_get_setting( 'variable-product-button-text', 'Select Options' ) ); ?>"
							name="variable-product-button-text" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Variable Product Behavior', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'move  to top add to cart button. ', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<select class="wsatc-select" name="variable-button-behaviour">
							<option <?php selected( $this->wsatc_get_setting( 'variable-button-behaviour' ), 'regular' ); ?>
								value="regular"><?php esc_html_e( 'Add to Cart', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'variable-button-behaviour' ), 'select-variation' ); ?>
								value="select-variation"><?php esc_html_e( 'Select Options', 'woo-sticky-add-to-cart' ); ?></option>
						</select>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Sticky Bar Position', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Either to show top or bottom of the page', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<select class="wsatc-select" name="sticky-bar-position">
							<option <?php selected( $this->wsatc_get_setting( 'sticky-bar-position' ), 'top' ); ?> value="top">
								<?php esc_html_e( 'Top', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'sticky-bar-position' ), 'bottom' ); ?> value="bottom">
								<?php esc_html_e( 'Bottom', 'woo-sticky-add-to-cart' ); ?></option>
						</select>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Show After Scroll Pixels', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Show sticky bar after how many pixel scroll. Make sure you already activated <b>Show After Scroll</b> from Visibility section', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<input type="text" name="wsatc-pixels-to-hide"
							value="<?php esc_html_e( $this->wsatc_get_setting( 'wsatc-pixels-to-hide' ) ); ?>" 
							placeholder="<?php echo __( '10', 'woo-sticky-add-to-cart' ); ?>">
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Cart Button Style', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Add to cart button styles', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<select class="wsatc-select" name="sticky-cart-btn-style">
							<option <?php selected( $this->wsatc_get_setting( 'sticky-cart-btn-style' ), 'square' ); ?>
								value="square"><?php esc_html_e( 'Square', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'sticky-cart-btn-style' ), 'round' ); ?> value="round">
								<?php esc_html_e( 'Round', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'sticky-cart-btn-style' ), 'half-round' ); ?> value="half-round"><?php esc_html_e( 'Half Round', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'sticky-cart-btn-style' ), 'half-round-2' ); ?> value="half-round-2"><?php esc_html_e( 'Half Round 2', 'woo-sticky-add-to-cart' ); ?></option>
						</select>
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Product Image Style', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Product Image Style', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<select class="wsatc-select" name="sticky-image-style">
							<option <?php selected( $this->wsatc_get_setting( 'sticky-image-style' ), 'square' ); ?> value="square">
								<?php esc_html_e( 'Square', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'sticky-image-style' ), 'round' ); ?> value="round">
								<?php esc_html_e( 'Round', 'woo-sticky-add-to-cart' ); ?></option>
						</select>
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Hide On Products', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Hide sticky bar on specific products', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">

						<input type="text" name="wsatc-hide-product"
							value="<?php esc_html_e( $this->wsatc_get_setting( 'wsatc-hide-product' ) ); ?>" 
							placeholder="<?php echo __( '1,2,3 comma separated product ID', 'woo-sticky-add-to-cart' ); ?>">
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Hide On Product Category', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Hide sticky bar on product categories', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
					<input type="text" name="wsatc-hide-cat"
							value="<?php esc_html_e( $this->wsatc_get_setting( 'wsatc-hide-cat' ) ); ?>" 
							placeholder="<?php echo __( '1,2,3 comma separated category ID', 'woo-sticky-add-to-cart' ); ?>">

					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Sale Badge', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Show sale/offer badge', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-sale-badge" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-sale-badge' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Sale Badge Text', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Sale Offer Badge Text', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text" value="<?php esc_html_e( $this->wsatc_get_setting( 'wcsatc-sale-text', '' ) ); ?>"
							name="wcsatc-sale-text" placeholder="<?php echo __( 'Sale', 'woo-sticky-add-to-cart' ); ?>" />
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Sale Badge Style', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'sale badge style ', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<select class="wsatc-select" name="wsatc-sale-badge-style">
						<option <?php selected( $this->wsatc_get_setting( 'wsatc-sale-badge-style' ), 'round' ); ?> value="round">
								<?php esc_html_e( 'Round', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'wsatc-sale-badge-style' ), 'square' ); ?>
								value="square"><?php esc_html_e( 'Square', 'woo-sticky-add-to-cart' ); ?></option>
						</select>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Review Stars', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Display stars rating', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-reviews" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-reviews' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Review Count', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Display stars rating count', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-reviews-count" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-reviews-count' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Box Shadow ', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Show sticky cart box shadow', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-box-shadow" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-box-shadow' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Show Quantity ', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Show quantity field on sticky add to cart', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-show-quantity" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-show-quantity', 1 ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Stock Count', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Show stock count', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-stock-count" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-stock-count' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Show Product image', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Show product image in sticky bar', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-show-image" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-show-image' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"> <?php esc_html_e( 'Ajax Add to Cart', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Ajax add to cart with out page reload.', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
						<?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="ajax-cart" value="1"
								<?php checked( $this->wsatc_get_setting( 'ajax-cart' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Cart Button Animation', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Animation for cart button. ', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<!--CHECK HERE-->
					<div class="wsatc-input">
						<select class="wsatc-select" name="wsatc-cart-btn-animation">
							<option <?php selected( $this->wsatc_get_setting( 'wsatc-cart-btn-animation' ), '' ); ?> value="">
								<?php esc_html_e( 'None', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'wsatc-cart-btn-animation' ), 'wiggle' ); ?>
								value="wiggle"><?php esc_html_e( 'Wiggle', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'wsatc-cart-btn-animation' ), 'horizontal' ); ?>
								value="horizontal"><?php esc_html_e( 'Horizontal', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'wsatc-cart-btn-animation' ), 'vertical' ); ?> value="vertical">
								<?php esc_html_e( 'Vertical', 'woo-sticky-add-to-cart' ); ?></option>
								<option <?php selected( $this->wsatc_get_setting( 'wsatc-cart-btn-animation' ), 'shake' ); ?> value="shake">
								<?php esc_html_e( 'Shake', 'woo-sticky-add-to-cart' ); ?></option>
								<option <?php selected( $this->wsatc_get_setting( 'wsatc-cart-btn-animation' ), 'wobble' ); ?> value="wobble">
								<?php esc_html_e( 'Wobble', 'woo-sticky-add-to-cart' ); ?></option>

						</select>
					</div>
				</div>

				<div class="wsatc-row input-wrapper">
					<div class="wsatc-label-wrapper">
						<?php esc_html_e( 'Price Range On Variable Product', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Show price range on variable product', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-variable-price" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-variable-price' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper">
						<?php esc_html_e( 'Show Price', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Enable / Disable to show price', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-price" value="1"
								<?php checked( $this->wsatc_get_setting( 'wsatc-price', 1 ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Price Badge Style', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'sale badge style ', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<select class="wsatc-select" name="wsatc-price-badge-style">
						<option <?php selected( $this->wsatc_get_setting( 'wsatc-price-badge-style' ), 'round' ); ?>
								value="round"><?php esc_html_e( 'Round', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'wsatc-price-badge-style' ), 'square' ); ?>
								value="square"><?php esc_html_e( 'Square', 'woo-sticky-add-to-cart' ); ?></option>
						</select>
					</div>
				</div>
				<div class="wsatc-row input-wrapper <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper">
						<?php esc_html_e( 'Redirect after "ATC"', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Redirect after product add to cart', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<label class="switch">
							<input type="checkbox" name="wsatc-redirect" value="1" 
								<?php checked( $this->wsatc_get_setting( 'wsatc-redirect' ), 1, true ); ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="wsatc-row input-wrapper wsatc-redirect-opt wsatc-hide <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper"><?php esc_html_e( 'Redirect', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Redirect location after "Add to Cart" is clicked', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<select class="wsatc-select" id="wsatc-redirect-location" name="wsatc-redirect-location">
							<option <?php selected( $this->wsatc_get_setting( 'wsatc-redirect-location' ), 'checkout' ); ?>
								value="checkout"><?php esc_html_e( 'Checkout', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'wsatc-redirect-location' ), 'cart' ); ?>
								value="cart"><?php esc_html_e( 'Cart', 'woo-sticky-add-to-cart' ); ?></option>
							<option <?php selected( $this->wsatc_get_setting( 'wsatc-redirect-location' ), 'custom_url' ); ?>
								value="custom_url"><?php esc_html_e( 'Custom URL', 'woo-sticky-add-to-cart' ); ?></option>
						</select>
					</div>
				</div>
				<div class="wsatc-row input-wrapper wsatc-custom-url wsatc-hide <?php $this->is_pro_class(); ?>">
					<div class="wsatc-label-wrapper">
						<?php esc_html_e( 'Redirect location URL', 'woo-sticky-add-to-cart' ); ?>
						<div class="wsatc-tooltip">?<span class="tooltiptext">
								<p><?php echo __( 'Location where page will be redirected after "Add to Cart is clicked" ', 'woo-sticky-add-to-cart' ); ?></p>
							</span></div><?php $this->is_pro_setting(); ?>
					</div>
					<div class="wsatc-input">
						<input type="text"
							value="<?php esc_html_e( $this->wsatc_get_setting( 'wsatc-redirect-url' ) ); ?>"
							name="wsatc-redirect-url" />
					</div>
				</div>

			</div>
			<!--Configuraion tab end-->
			<?php require_once 'wsatc-size-settings.php'; ?>
			<?php do_action( 'wsatc_tab_content_end' ); ?>
			<div id="wsatc-submit-opition">
				<input type="submit" class="reset-button button-secondary wsatc" name="reset" value="Restore Defaults">
				<input type="submit" class="button-primary wsatc" name="update" value="Save Settings">
			</div>
			<?php do_action( 'wsatc_setting_form_end' ); ?>
		</form>
	</div>
	<?php do_action( 'wsatc_after_setting_end_wrapper' ); ?>
</div>
<?php do_action( 'wsatc_after_end_wrapper' ); ?>