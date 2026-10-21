<?php
/**
 * Checkout order review table.
 *
 * Override of woocommerce/templates/checkout/review-order.php.
 *
 * Rendered into #order_review by woocommerce_order_review(). WooCommerce
 * replaces the whole of #order_review over AJAX whenever an address, shipping
 * method or coupon changes, so nothing here may depend on page-load JS.
 *
 * Kept as a <table>: wc_cart_totals_shipping_html() and the fee/tax helpers
 * print their own <tr>/<td> rows into the footer.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

$sgz_th = 'text-left align-baseline py-3 pr-4 text-sm font-medium text-neutral-600 dark:text-neutral-400 border-b border-neutral-100 dark:border-neutral-800';
$sgz_td = 'text-right align-baseline py-3 text-sm font-bold text-neutral-900 dark:text-white border-b border-neutral-100 dark:border-neutral-800';
?>
<table class="shop_table woocommerce-checkout-review-order-table w-full border-collapse">

	<thead>
		<tr>
			<th class="product-name text-left pb-3 <?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Product', 'shop-groznet' ); ?></th>
			<th class="product-total text-right pb-3 <?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Subtotal', 'shop-groznet' ); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<td class="product-name <?php echo esc_attr( $sgz_th ); ?>">
						<span class="text-neutral-900 dark:text-white font-medium">
							<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
						</span>
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity text-neutral-500 dark:text-neutral-400">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<?php wc_get_formatted_cart_item_data( $cart_item ); ?>
					</td>
					<td class="product-total <?php echo esc_attr( $sgz_td ); ?>">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>

	<tfoot>

		<tr class="cart-subtotal">
			<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php esc_html_e( 'Subtotal', 'shop-groznet' ); ?></th>
			<td class="<?php echo esc_attr( $sgz_td ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td class="<?php echo esc_attr( $sgz_td ); ?> text-brand-600 dark:text-brand-400"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php echo esc_html( $fee->name ); ?></th>
				<td class="<?php echo esc_attr( $sgz_td ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
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
						<td class="<?php echo esc_attr( $sgz_td ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
					<?php
				}
			} else {
				?>
				<tr class="tax-total">
					<th class="<?php echo esc_attr( $sgz_th ); ?>"><?php echo esc_html( WC()->countries->tax_or_vat() ) . wp_kses_post( $estimated_text ); ?></th>
					<td class="<?php echo esc_attr( $sgz_td ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_before_order_total' );
		?>

		<tr class="order-total">
			<th class="text-left align-baseline pt-4 pr-4 text-base font-bold text-neutral-900 dark:text-white"><?php esc_html_e( 'Total', 'shop-groznet' ); ?></th>
			<td class="text-right align-baseline pt-4 <?php sgz_ui_class( 'price' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>

</table>
