<?php
/**
 * Single product gallery.
 *
 * Override of woocommerce/templates/single-product/product-image.php.
 *
 * The .woocommerce-product-gallery wrapper, its data-columns attribute and the
 * inline opacity transition are reproduced exactly: single-product.js keys the
 * FlexSlider/PhotoSwipe setup off that class and fades the gallery in by
 * setting the inline opacity to 1 once it has initialised.
 *
 * Because those wrapper classes are passed through sanitize_html_class(), the
 * rounded surface is applied to an outer div instead -- Tailwind's variant
 * syntax uses colons, which sanitize_html_class() strips.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="sgz-gallery rounded-2xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-neutral-100 dark:bg-neutral-800 shadow-sm">
	<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
		<figure class="woocommerce-product-gallery__wrapper m-0">
			<?php
			if ( $post_thumbnail_id ) {
				$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'shop-groznet' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:ignore WordPress.Security.EscapeOutput

			do_action( 'woocommerce_product_thumbnails' );
			?>
		</figure>
	</div>
</div>
