<?php
/**
 * Product gallery thumbnails.
 *
 * Override of woocommerce/templates/single-product/product-thumbnails.php.
 *
 * wc_get_gallery_image_html() builds each thumbnail with the data attributes
 * FlexSlider and PhotoSwipe read, so the loop is unchanged. Layout of the
 * thumbnail strip is in assets/css/woocommerce.css, since the elements are
 * generated in PHP.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && $product->get_image_id() ) {
	foreach ( $attachment_ids as $attachment_id ) {
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}
