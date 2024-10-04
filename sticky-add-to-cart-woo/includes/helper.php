<?php

/**
 * Get setting.
 *
 * @since 1.0.0
 * @return  array
 */
function wsatc_get_settings() {
	return get_option( 'wsatc_options' );
}

/**
 * Get setting.
 *
 * @since 1.0.0
 * @return  mixed
 */
function wsatc_get_setting( $setting, $default = '' ) {

	$settings = wsatc_get_settings();
	if ( isset( $settings[ $setting ] ) ) {
		return $settings[ $setting ];
	} else {
		return $default;
	}
}


/**
 * Is woo installed.
 *
 * @since 1.0.0
 * @return boolean
 */
function wsatc_is_woo() {
	return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}

/**
 * Hexa to rgba converter.
 *
 * @since 1.0.0
 * @param string $hex color.
 * @return string gba color.
 */
function wsatc_hex_to_rgba( $hex ) {
	list($r, $g, $b) = sscanf( $hex, '#%02x%02x%02x' );
	return "$r,$g,$b";
}

/**
 * Check is pro active.
 *
 * @since 1.0.0
 * @return void
 */
function wsatc_is_pro() {
	return class_exists( 'Wsatc_Pro' );
}

/**
 * Admin notice for WooCommerce Activation.
 *
 * @since 1.0.0
 * @return void
 */
function wsatc_woo_require_notice() {
	$action         = 'install-plugin';
	$slug           = 'woocommerce';
	$plugin_install = wp_nonce_url(
		add_query_arg(
			array(
				'action' => $action,
				'plugin' => $slug,
			),
			admin_url( 'update.php' )
		),
		$action . '_' . $slug
	);

	echo "<div class='error notice-info is-dismissible'>
					<p><strong>Simple Sticky Add To Cart For WooCommerce </strong> requires WooCommerce Active & Install <a href='$plugin_install'>Click here</a> to Install.</p> 
			 </div>";
}


/**
 * Plugin activation path.
 *
 * @since 1.0.0
 * @return string
 */
function wsatc_activate_path() {
	return 'sticky-add-to-cart-woo/woo-sticky-add-to-cart.php';
}

/**
 * Nice Format of the number.
 *
 * @since 1.3.0
 * @param int $n
 * @return string
 */
function wsatc_nice_number( $n ) {
	$temp_number = str_replace( ',', '', $n );
	if ( ! empty( $temp_number ) ) {
			$n = ( 0 + $temp_number );
	} else {
			$n = $n;
	}
	if ( ! is_numeric( $n ) ) {
		return 0;
	}
	$is_neg = false;
	if ( $n < 0 ) {
			$is_neg = true;
			$n      = abs( $n );
	}
	$number = 0;
	$suffix = '';
	switch ( true ) {
		case $n >= 1000000000000:
				$number = ( $n / 1000000000000 );
				$suffix = $n > 1000000000000 ? 'T+' : 'T';
			break;
		case $n >= 1000000000:
				$number = ( $n / 1000000000 );
				$suffix = $n > 1000000000 ? 'B+' : 'B';
			break;
		case $n >= 1000000:
				$number = ( $n / 1000000 );
				$suffix = $n > 1000000 ? 'M+' : 'M';
			break;
		case $n >= 1000:
				$number = ( $n / 1000 );
				$suffix = $n > 1000 ? 'K+' : 'K';
			break;
		default:
				$number = $n;
			break;
	}
	if ( strpos( $number, '.' ) !== false && strpos( $number, '.' ) >= 0 ) {
			$number = number_format( $number, 1 );
	}
	return ( $is_neg ? '-' : '' ) . $number . $suffix;
}

/**
 * Check is black friday discount available.
 *
 * @since 1.0.0
 * @return bool
 */
function wsatc_is_black_friday(): bool {
	/**
	* define( 'WSATC_BLACK_FRIDAY', '2022-08-01' ) // yyyy-mm-dd
	*/

	if ( defined( 'WSATC_BLACK_FRIDAY' ) && ! defined( 'WSATC_PRO_VERSION' )
			&& time() < strtotime( WSATC_BLACK_FRIDAY ) ) {
		return true;
	}

	return false;
}
