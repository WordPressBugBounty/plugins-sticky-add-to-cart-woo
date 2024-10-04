<div class="wsatc-tabs">
	<button class="tab-link active" id="visibility"><?php esc_html_e( 'Visibillity', 'woo-sticky-add-to-cart' ); ?></button>
	<button class="tab-link" id="design"><?php esc_html_e( 'Design', 'woo-sticky-add-to-cart' ); ?></button>
	<button class="tab-link" id="fonts"><?php esc_html_e( 'Fonts', 'woo-sticky-add-to-cart' ); ?></button>
	<button class="tab-link" id="configuration"><?php esc_html_e( 'Configuration', 'woo-sticky-add-to-cart' ); ?></button>
	<a class="tab-link" href="<?php echo esc_url( 'https://wordpress.org/support/plugin/sticky-add-to-cart-woo/' ); ?>" target="_blank"><?php esc_html_e( 'Support', 'woo-sticky-add-to-cart' ); ?></a>
	<?php if ( ! wsatc_is_pro() ) : ?>
		<a class="tab-link pro-menu" href="<?php echo esc_url( WSATC_PRO_LINK ); ?>" target="_blank"><?php esc_html_e( 'Upgrade To Pro', 'woo-sticky-add-to-cart' ); ?></a>
	<?php endif; ?>
	<?php do_action( 'wsatc_setting_tab_button' ); ?>
</div>