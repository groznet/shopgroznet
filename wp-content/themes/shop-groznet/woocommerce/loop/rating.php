<?php
/**
 * Star rating in the loop.
 *
 * Override of woocommerce/templates/loop/rating.php.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) :
	?>
	<div class="sgz-rating mt-2 flex items-center gap-2">
		<?php echo wc_get_rating_html( $average, $rating_count ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<span class="<?php sgz_ui_class( 'muted' ); ?>">
			<?php
			printf(
				/* translators: %s: number of reviews. */
				esc_html( _n( '%s review', '%s reviews', $rating_count, 'shop-groznet' ) ),
				esc_html( number_format_i18n( $rating_count ) )
			);
			?>
		</span>
	</div>
	<?php
endif;
