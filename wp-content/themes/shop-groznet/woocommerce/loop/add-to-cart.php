<?php
/**
 * Add to cart button in the product loop.
 *
 * Override of woocommerce/templates/loop/add-to-cart.php.
 *
 * The class list, data-* attributes and the woocommerce_loop_add_to_cart_link
 * filter are preserved: add_to_cart_button and ajax_add_to_cart are what
 * WooCommerce's add-to-cart.js binds to, and the data attributes are what it
 * posts. Only presentational classes are added.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product ) {
	return;
}

$args = isset( $args ) && is_array( $args ) ? $args : array();

$defaults = array(
	'quantity'   => 1,
	'class'      => implode(
		' ',
		array_filter(
			array(
				'button',
				'product_type_' . $product->get_type(),
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
			)
		)
	),
	'attributes' => array(
		'data-product_id'  => $product->get_id(),
		'data-product_sku' => $product->get_sku(),
		// These two accessors are recent additions to WC_Product; older
		// WooCommerce releases would fatal on them.
		'aria-label'       => method_exists( $product, 'add_to_cart_description' ) ? $product->add_to_cart_description() : $product->add_to_cart_text(),
		'aria-describedby' => method_exists( $product, 'add_to_cart_aria_describedby' ) ? $product->add_to_cart_aria_describedby() : '',
		'rel'              => 'nofollow',
	),
);

$args = wp_parse_args( $args, $defaults );

// Theme styling, appended to whatever WooCommerce and plugins have set.
$args['class'] = trim( $args['class'] . ' ' . sgz_ui( 'btn_primary_sm' ) . ' w-full' );

if ( isset( $args['attributes']['aria-describedby'] ) && ! $args['attributes']['aria-describedby'] ) {
	unset( $args['attributes']['aria-describedby'] );
}

echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput
	'woocommerce_loop_add_to_cart_link',
	sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $product->add_to_cart_text() )
	),
	$product,
	$args
);
