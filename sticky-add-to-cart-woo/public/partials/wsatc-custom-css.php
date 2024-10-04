<style>
<?php
$product = wc_get_product();

do_action( 'wsatc_custom_style_start' );
?>
.wsatc-stick-cart-wrapper{
	background-color:<?php esc_attr_e( wsatc_get_setting( 'sticky-background-color' ) ); ?>;
	color: <?php esc_attr_e( wsatc_get_setting( 'sticky-text-color' ) ); ?>;
}

.wsatc-stick-cart-wrapper .wsatc-add-to-cart{
	background-color:<?php esc_attr_e( wsatc_get_setting( 'cart-button-color' ) ); ?>;
	color:<?php esc_attr_e( wsatc_get_setting( 'cart-button-text-color' ) ); ?>;
}
.wsatc-stick-cart-wrapper .wsatc-add-to-cart:hover{
	background-color:<?php esc_attr_e( wsatc_get_setting( 'cart-button-hover-color' ) ); ?>;
	color:<?php esc_attr_e( wsatc_get_setting( 'cart-button-hover-text-color' ) ); ?>;
}
.wsatc-rating  .star-rating{
	color: <?php esc_attr_e( wsatc_get_setting( 'sticky-stars-color' ) ); ?>;
}
.wsatc-rating-count{
	color: <?php esc_attr_e( wsatc_get_setting( 'sticky-rating-count-color' ) ); ?>;
}
<?php if ( ! wsatc_get_setting( 'wsatc-box-shadow' ) ) : ?>
	.wsatc-stick-cart-wrapper {
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;
	}
<?php endif; ?>

<?php if ( ! wsatc_get_setting( 'wsatc-show-image' ) ) : ?>
	.wsatc-product-img {
		display: none;
	}
<?php endif; ?>

<?php if ( wsatc_get_setting( 'sticky-stock-color' ) ) : ?>
	.wsatc-stock {
		color: <?php esc_attr_e( wsatc_get_setting( 'sticky-stock-color' ) ); ?>
	}
<?php endif; ?>

<?php if ( $product->is_type( 'variable' ) && ! wsatc_get_setting( 'wsatc-variable-price' ) ) : ?>
	.wsatc-price {
		display: none;
	}
<?php endif; ?>

<?php if ( wsatc_get_setting( 'title-font-size' ) ) : ?>
	.wsatc-container .product-title{
		font-size: <?php esc_attr_e( wsatc_get_setting( 'title-font-size' ) ); ?>
	}
<?php endif; ?>

<?php if ( wsatc_get_setting( 'button-font-size' ) ) : ?>
	.wsatc-container .wsatc-add-to-cart {
		font-size: <?php esc_attr_e( wsatc_get_setting( 'button-font-size' ) ); ?>
	}
<?php endif; ?>

<?php if ( wsatc_get_setting( 'price-font-size' ) ) : ?>
	.wsatc-container .wsatc-price {
		font-size: <?php esc_attr_e( wsatc_get_setting( 'price-font-size' ) ); ?>
	}
	.wsatc-qty-minus,
	.wsatc-qty-plus {
		font-size: <?php esc_attr_e( wsatc_get_setting( 'price-font-size' ) ); ?>
	}
<?php endif; ?>

<?php if ( wsatc_get_setting( 'sale-font-size' ) ) : ?>
	.wsatc-sale {
		font-size: <?php esc_attr_e( wsatc_get_setting( 'sale-font-size' ) ); ?>
	}
<?php endif; ?>

<?php if ( wsatc_get_setting( 'stock-font-size' ) ) : ?>
	.wsatc-stock {
		font-size: <?php esc_attr_e( wsatc_get_setting( 'stock-font-size' ) ); ?>
	}
<?php endif; ?>

<?php if ( wsatc_get_setting( 'review-font-size' ) ) : ?>
	.wsatc-rating {
		font-size: <?php esc_attr_e( wsatc_get_setting( 'review-font-size' ) ); ?>
	}
<?php endif; ?>

<?php if ( ! wsatc_get_setting( 'wsatc-show-quantity', 1 ) ) : ?>
	.wsatc-qty-wrapper {
		display: none !important;
	}
<?php endif; ?>

<?php do_action( 'wsatc_custom_style_end' ); ?>
</style>