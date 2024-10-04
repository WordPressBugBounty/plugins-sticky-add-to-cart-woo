<div class="wsatc-tab-content fonts">
	<h3><?php esc_html_e( 'Fonts Settings', 'woo-sticky-add-to-cart' ); ?></h3>
	<div class="wsatc-row input-wrapper">
		<div class="wsatc-label-wrapper">
			<?php esc_html_e( 'Title Font size', 'woo-sticky-add-to-cart' ); ?>
			<div class="wsatc-tooltip">?<span class="tooltiptext">
					<p><?php echo __( 'Product title font size', 'woo-sticky-add-to-cart' ); ?></p>
				</span></div>
		</div>
		<div class="wsatc-input">
			<input type="text"
				value="<?php esc_html_e( $this->wsatc_get_setting( 'title-font-size' ) ); ?>"
				name="title-font-size" placeholder="16px" />
		</div>
	</div>
	<div class="wsatc-row input-wrapper">
		<div class="wsatc-label-wrapper">
			<?php esc_html_e( 'Add to Cart Button Font size', 'woo-sticky-add-to-cart' ); ?>
			<div class="wsatc-tooltip">?<span class="tooltiptext">
					<p><?php echo __( 'Add to cart button font size', 'woo-sticky-add-to-cart' ); ?></p>
				</span></div>
		</div>
		<div class="wsatc-input">
			<input type="text"
				value="<?php esc_html_e( $this->wsatc_get_setting( 'button-font-size' ) ); ?>"
				name="button-font-size" placeholder="16px" />
		</div>
	</div>
	<div class="wsatc-row input-wrapper">
		<div class="wsatc-label-wrapper">
			<?php esc_html_e( 'Price Font size', 'woo-sticky-add-to-cart' ); ?>
			<div class="wsatc-tooltip">?<span class="tooltiptext">
					<p><?php echo __( 'Product price in sticky bar', 'woo-sticky-add-to-cart' ); ?></p>
				</span></div>
		</div>
		<div class="wsatc-input">
			<input type="text"
				value="<?php esc_html_e( $this->wsatc_get_setting( 'price-font-size' ) ); ?>"
				name="price-font-size" placeholder="16px" />
		</div>
	</div>
	<div class="wsatc-row input-wrapper">
		<div class="wsatc-label-wrapper">
			<?php esc_html_e( 'Sale Font size', 'woo-sticky-add-to-cart' ); ?>
			<div class="wsatc-tooltip">?<span class="tooltiptext">
					<p><?php echo __( 'Sale text in sticky bar font size', 'woo-sticky-add-to-cart' ); ?></p>
				</span></div>
		</div>
		<div class="wsatc-input">
			<input type="text"
				value="<?php esc_html_e( $this->wsatc_get_setting( 'sale-font-size' ) ); ?>"
				name="sale-font-size" placeholder="16px" />
		</div>
	</div>
	<div class="wsatc-row input-wrapper">
		<div class="wsatc-label-wrapper">
			<?php esc_html_e( 'Stock management Font size', 'woo-sticky-add-to-cart' ); ?>
			<div class="wsatc-tooltip">?<span class="tooltiptext">
					<p><?php echo __( 'Stock count and text in sticky bar font size', 'woo-sticky-add-to-cart' ); ?></p>
				</span></div>
		</div>
		<div class="wsatc-input">
			<input type="text"
				value="<?php esc_html_e( $this->wsatc_get_setting( 'stock-font-size' ) ); ?>"
				name="stock-font-size" placeholder="16px" />
		</div>
	</div>
	<div class="wsatc-row input-wrapper">
		<div class="wsatc-label-wrapper">
			<?php esc_html_e( 'Review Font size', 'woo-sticky-add-to-cart' ); ?>
			<div class="wsatc-tooltip">?<span class="tooltiptext">
					<p><?php echo __( 'review stars and count in  sticky bar font size', 'woo-sticky-add-to-cart' ); ?></p>
				</span></div>
		</div>
		<div class="wsatc-input">
			<input type="text"
				value="<?php esc_html_e( $this->wsatc_get_setting( 'review-font-size' ) ); ?>"
				name="review-font-size" placeholder="16px" />
		</div>
	</div>
</div>