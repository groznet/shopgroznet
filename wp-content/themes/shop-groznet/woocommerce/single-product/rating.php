<?php
/**
 * Single product rating.
 *
 * Override of woocommerce/templates/single-product/rating.php.
 *
 * wc_get_rating_html() generates the star markup in PHP; its styling lives in
 * assets/css/woocommerce.css because the stars are a CSS-content technique
 * that utility classes cannot express.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>

	<div class="woocommerce-product-rating flex flex-wrap items-center gap-3">

		<?php echo wc_get_rating_html( $average, $rating_count ); // phpcs:ignore WordPress.Security.EscapeOutput ?>

		<?php if ( comments_open() ) : ?>
			<a href="#reviews" class="woocommerce-review-link text-sm text-neutral-500 dark:text-neutral-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors" rel="nofollow">
				<?php
				printf(
					/* translators: %s: number of customer reviews. */
					esc_html( _n( '%s customer review', '%s customer reviews', $review_count, 'shop-groznet' ) ),
					'<span class="count">' . esc_html( $review_count ) . '</span>' // phpcs:ignore WordPress.Security.EscapeOutput
				);
				?>
			</a>
		<?php endif; ?>

	</div>

<?php endif;
