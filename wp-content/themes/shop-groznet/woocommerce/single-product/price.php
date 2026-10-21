<?php
/**
 * Single product price.
 *
 * Override of woocommerce/templates/single-product/price.php.
 *
 * The .price class and the get_price_html() output are preserved --
 * add-to-cart-variation.js replaces this element's contents for variable
 * products, and structured data reads from it. The <del>/<ins> markup inside
 * get_price_html() is generated in PHP, so its styling lives in
 * assets/css/woocommerce.css.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> <?php sgz_ui_class( 'price_lg' ); ?>">
	<?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
</p>
