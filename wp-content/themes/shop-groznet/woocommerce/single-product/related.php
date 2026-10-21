<?php
/**
 * Related products.
 *
 * Override of woocommerce/templates/single-product/related.php.
 *
 * Reuses loop-start.php and content-product.php, so the related row is the
 * same card grid as the shop archive. Section framing follows the static
 * site's portfolio header: eyebrow, serif heading, brand rule.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( $related_products ) : ?>

	<section class="related products mt-16 pt-12 border-t border-neutral-100 dark:border-neutral-800">

		<div class="mb-8 space-y-3">
			<span class="<?php sgz_ui_class( 'eyebrow' ); ?>"><?php esc_html_e( 'Keep looking', 'shop-groznet' ); ?></span>

			<?php
			$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'shop-groznet' ) );

			if ( $heading ) :
				?>
				<h2 class="<?php sgz_ui_class( 'h2' ); ?>"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>

			<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>
		</div>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				$post_object = get_post( $related_product->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore

				wc_get_template_part( 'content', 'product' );
				?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

	<?php
endif;

wp_reset_postdata();
