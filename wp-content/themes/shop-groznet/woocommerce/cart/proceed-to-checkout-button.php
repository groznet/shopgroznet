<?php
/**
 * Proceed to checkout button.
 *
 * Override of woocommerce/templates/cart/proceed-to-checkout-button.php.
 *
 * Overridden only to carry the theme's primary button classes; the
 * .checkout-button class and the checkout URL are unchanged.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
	class="checkout-button button alt wc-forward <?php sgz_ui_class( 'btn_primary' ); ?> w-full">
	<?php esc_html_e( 'Proceed to checkout', 'shop-groznet' ); ?>
	<?php echo sgz_icon( 'arrow-right', 'w-4 h-4' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
</a>
