<?php
/**
 * Sale badge in the product loop.
 *
 * Override of woocommerce/templates/loop/sale-flash.php.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;

if ( $product->is_on_sale() ) :
	echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput
		'woocommerce_sale_flash',
		'<span class="onsale absolute top-4 left-4 z-10 ' . esc_attr( sgz_ui( 'badge' ) ) . '">' . esc_html__( 'Sale', 'shop-groznet' ) . '</span>',
		$post,
		$product
	);
endif;
