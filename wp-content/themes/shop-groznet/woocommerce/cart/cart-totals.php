<?php
/**
 * Cart totals panel.
 *
 * Override of woocommerce/templates/cart/cart-totals.php.
 *
 * Rendered into the cart's right-hand column by woocommerce_cart_totals(),
 * hooked on woocommerce_cart_collaterals. Styled as the static site's contact
 * panel: white / neutral-900 surface, rounded-2xl, hairline border, shadow-sm.
 *
 * This stays a real <table>. wc_cart_totals_shipping_html() and the fee/tax
 * helpers print <tr>/<td> markup of their own, and WooCommerce replaces the
 * shipping rows over AJAX when the shipping method changes; a <div> layout
 * here would leave that markup invalid and the rows would be hoisted out of
 * the panel by the browser.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

$sgz_th = 'text-left align-baseline py-3 pr-4 text-sm font-medium text-neutral-600 dark:text-neutral-400 border-b border-neutral-100 dark:border-neutral-800';
$sgz_td = 'text-right align-baseline py-3 text-sm font-bold text-neutral-900 dark:text-white border-b border-neutral-100 dark:border-neutral-800';
?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?> <?php sgz_ui_class( 'panel_tight' ); ?>">

	<?php
	/**
	 * Hook: woocommerce_before_cart_totals.
	 */
	do_action( 'woocommerce_before_cart_totals' );
	?>

	<h2 class="<?php sgz_ui_class( 'h3' ); ?> mb-2"><?php esc_html_e( 'Cart totals', 'shop-groznet' ); ?></h2>

	<table cellspacing="0" class="shop_table shop_table_responsive sgz-totals w-full border-collapse">
		<tbody>

			<tr class="cart-subtotal">
				<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php esc_html_e( 'Subtotal', 'shop-groznet' ); ?></th>
				<td class="<?php echo esc_attr( $sgz_td ); ?>" data-title="<?php esc_attr_e( 'Subtotal', 'shop-groznet' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
			</tr>

			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
					<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td class="<?php echo esc_attr( $sgz_td ); ?> text-brand-600 dark:text-brand-400" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

				<?php
				/**
				 * Hook: woocommerce_cart_totals_before_shipping.
				 */
				do_action( 'woocommerce_cart_totals_before_shipping' );

				// Prints its own <tr class="woocommerce-shipping-totals shipping">.
				wc_cart_totals_shipping_html();

				/**
				 * Hook: woocommerce_cart_totals_after_shipping.
				 */
				do_action( 'woocommerce_cart_totals_after_shipping' );
				?>

			<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

				<tr class="shipping">
					<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php esc_html_e( 'Shipping', 'shop-groznet' ); ?></th>
					<td class="<?php echo esc_attr( $sgz_td ); ?> font-normal" data-title="<?php esc_attr_e( 'Shipping', 'shop-groznet' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
				</tr>

			<?php endif; ?>

			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee">
					<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php echo esc_html( $fee->name ); ?></th>
					<td class="<?php echo esc_attr( $sgz_td ); ?>" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php
			if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
				$taxable_address = WC()->customer->get_taxable_address();
				$estimated_text  = '';

				if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
					/* translators: %s: country name. */
					$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'shop-groznet' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
				}

				if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
					foreach ( WC()->cart->get_tax_totals() as $code => $tax ) {
						?>
						<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
							<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php echo esc_html( $tax->label ) . wp_kses_post( $estimated_text ); ?></th>
							<td class="<?php echo esc_attr( $sgz_td ); ?>" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
						</tr>
						<?php
					}
				} else {
					?>
					<tr class="tax-total">
						<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php echo esc_html( WC()->countries->tax_or_vat() ) . wp_kses_post( $estimated_text ); ?></th>
						<td class="<?php echo esc_attr( $sgz_td ); ?>" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
					</tr>
					<?php
				}
			}

			/**
			 * Hook: woocommerce_cart_totals_before_order_total.
			 */
			do_action( 'woocommerce_cart_totals_before_order_total' );
			?>

			<tr class="order-total">
				<th class="text-left align-baseline pt-4 pr-4 text-base font-bold text-neutral-900 dark:text-white"><?php esc_html_e( 'Total', 'shop-groznet' ); ?></th>
				<td class="text-right align-baseline pt-4 <?php sgz_ui_class( 'price' ); ?>" data-title="<?php esc_attr_e( 'Total', 'shop-groznet' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
			</tr>

			<?php
			/**
			 * Hook: woocommerce_cart_totals_after_order_total.
			 */
			do_action( 'woocommerce_cart_totals_after_order_total' );
			?>

		</tbody>
	</table>

	<div class="wc-proceed-to-checkout mt-6">
		<?php
		/**
		 * Hook: woocommerce_proceed_to_checkout.
		 *
		 * @hooked woocommerce_button_proceed_to_checkout - 20
		 */
		do_action( 'woocommerce_proceed_to_checkout' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_cart_totals.
	 */
	do_action( 'woocommerce_after_cart_totals' );
	?>
</div>
