<?php
/**
 * Checkout payment methods and place-order button.
 *
 * Override of woocommerce/templates/checkout/payment.php.
 *
 * Reproduced exactly, because the checkout will not submit without them:
 *   - the #payment wrapper and .wc_payment_methods list
 *   - the woocommerce-process_checkout nonce and its
 *     woocommerce-process-checkout-nonce field name
 *   - the #place_order button with name="woocommerce_checkout_place_order"
 *     and its data-value attribute (checkout.js restores the label from it)
 *   - the <noscript> fallback submit
 *
 * The button classes are applied through the existing
 * woocommerce_order_button_html filter (see sgz_order_button_html()).
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_ajax() ) {
	/**
	 * Hook: woocommerce_review_order_before_payment.
	 */
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
<div id="payment" class="woocommerce-checkout-payment mt-6 pt-6 border-t border-neutral-100 dark:border-neutral-800">

	<?php if ( WC()->cart->needs_payment() ) : ?>
		<ul class="wc_payment_methods payment_methods methods list-none p-0 m-0 space-y-3">
			<?php
			if ( ! empty( $available_gateways ) ) {
				foreach ( $available_gateways as $gateway ) {
					wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
				}
			} else {
				echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info ' . esc_attr( sgz_ui( 'notice' ) ) . '">';
				echo wp_kses_post( apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.', 'shop-groznet' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'shop-groznet' ) ) );
				echo '</li>';
			}
			?>
		</ul>
	<?php endif; ?>

	<div class="form-row place-order mt-6">

		<noscript>
			<?php
			/* translators: $1 and $2 opening and closing emphasis tags respectively */
			printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'shop-groznet' ), '<em>', '</em>' );
			?>
			<br/><button type="submit" class="button alt <?php sgz_ui_class( 'btn_secondary' ); ?> mt-3" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'shop-groznet' ); ?>"><?php esc_html_e( 'Update totals', 'shop-groznet' ); ?></button>
		</noscript>

		<?php wc_get_template( 'checkout/terms.php' ); ?>

		<?php
		/**
		 * Hook: woocommerce_review_order_before_submit.
		 */
		do_action( 'woocommerce_review_order_before_submit' );
		?>

		<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>

		<?php
		/**
		 * Hook: woocommerce_review_order_after_submit.
		 */
		do_action( 'woocommerce_review_order_after_submit' );
		?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
	</div>
</div>
<?php
if ( ! is_ajax() ) {
	/**
	 * Hook: woocommerce_review_order_after_payment.
	 */
	do_action( 'woocommerce_review_order_after_payment' );
}
