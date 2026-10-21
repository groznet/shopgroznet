<?php
/**
 * Product card in the loop.
 *
 * Override of woocommerce/templates/content-product.php.
 *
 * Borderless card: rounded image with a scale-103 hover, text flush with the
 * image edges, action pinned to the bottom.
 *
 * The link-open/link-close, thumbnail and title callbacks are unhooked in
 * inc/woocommerce.php so the card can place them in separate boxes. Every
 * do_action() below is preserved so plugins still have their hook points.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$sgz_permalink = get_permalink();
?>
<li <?php wc_product_class( 'group relative flex flex-col', $product ); ?>>

	<div class="sgz-product-card__media relative aspect-square w-full overflow-hidden rounded-2xl bg-neutral-100 dark:bg-neutral-800">

		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10 (unhooked in inc/woocommerce.php)
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
		?>

		<a href="<?php echo esc_url( $sgz_permalink ); ?>"
			class="woocommerce-LoopProduct-link woocommerce-loop-product__link block w-full h-full focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500"
			tabindex="-1"
			aria-hidden="true">
			<?php
			echo wp_kses_post(
				$product->get_image(
					'woocommerce_thumbnail',
					array( 'class' => 'w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-103' )
				)
			);
			?>
		</a>

		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10 (unhooked in inc/woocommerce.php)
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
	</div>

	<div class="sgz-product-card__body pt-4 flex flex-col grow">

		<?php
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10 (unhooked in inc/woocommerce.php)
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
		?>

		<h2 class="woocommerce-loop-product__title <?php sgz_ui_class( 'h3' ); ?> group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors duration-200">
			<a href="<?php echo esc_url( $sgz_permalink ); ?>" class="focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 rounded">
				<?php echo esc_html( $product->get_name() ); ?>
			</a>
		</h2>

		<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

		<div class="sgz-product-card__actions mt-auto pt-5">
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5 (unhooked in inc/woocommerce.php)
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
		</div>
	</div>
</li>
