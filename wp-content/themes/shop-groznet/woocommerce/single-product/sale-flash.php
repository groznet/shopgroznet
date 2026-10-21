<?php
/**
 * Sale badge on the single product page.
 *
 * Override of woocommerce/templates/single-product/sale-flash.php.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;

if ( $product->is_on_sale() ) :
	echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput
		'woocommerce_sale_flash',
		'<span class="onsale absolute top-4 left-4 z-20 ' . esc_attr( sgz_ui( 'badge' ) ) . '">' . esc_html__( 'Sale', 'shop-groznet' ) . '</span>',
		$post,
		$product
	);
endif;
