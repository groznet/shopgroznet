<?php
/**
 * Single product content.
 *
 * Override of woocommerce/templates/content-single-product.php.
 *
 * The default template stacks the gallery above the summary. This version
 * puts them side by side in a two-column grid on large screens, matching the
 * media/copy split used throughout the static site. All hooks are preserved
 * and nothing is unhooked here -- the gallery, title, price, add-to-cart,
 * meta and tabs all still render from their normal callbacks.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'sgz-single-product', $product ); ?>>

	<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-start">

		<div class="sgz-single-product__media relative">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>

		<div class="summary entry-summary space-y-5">
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked sgz_single_title - 5 (replaces woocommerce_template_single_title)
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked sgz_single_excerpt - 20 (replaces woocommerce_template_single_excerpt)
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action( 'woocommerce_single_product_summary' );
			?>
		</div>

	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' );
