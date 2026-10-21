<?php
/**
 * Product price in the loop.
 *
 * Override of woocommerce/templates/loop/price.php.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( $price_html = $product->get_price_html() ) : // phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition
	?>
	<span class="price <?php sgz_ui_class( 'price' ); ?> mt-2 block"><?php echo wp_kses_post( $price_html ); ?></span>
	<?php
endif;
