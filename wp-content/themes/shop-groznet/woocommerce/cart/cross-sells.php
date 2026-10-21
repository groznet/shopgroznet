<?php
/**
 * Cross-sells on the cart page.
 *
 * Override of woocommerce/templates/cart/cross-sells.php.
 *
 * The default hook position puts these inside the narrow totals column;
 * inc/woocommerce.php moves woocommerce_cross_sell_display to
 * woocommerce_after_cart so the row runs full width under the cart, using
 * the same grid and card as the shop archive.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( $cross_sells ) : ?>

	<section class="cross-sells mt-16 pt-12 border-t border-neutral-100 dark:border-neutral-800">

		<div class="mb-8 space-y-3">
			<span class="<?php sgz_ui_class( 'eyebrow' ); ?>"><?php esc_html_e( 'You may also like', 'shop-groznet' ); ?></span>
			<h2 class="<?php sgz_ui_class( 'h2' ); ?>">
				<?php esc_html_e( 'Goes well with your order', 'shop-groznet' ); ?>
			</h2>
			<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>
		</div>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
				$post_object = get_post( $cross_sell->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore

				wc_get_template_part( 'content', 'product' );
				?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

	<?php
endif;

wp_reset_postdata();
