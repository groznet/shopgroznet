<?php
/**
 * Checkout coupon form.
 *
 * Override of woocommerce/templates/checkout/form-coupon.php.
 *
 * The .showcoupon link and the form.checkout_coupon element with its inline
 * display:none are what checkout.js slides open, so both are preserved. The
 * coupon_code field name and the apply_coupon button name are what
 * WC_Form_Handler reads.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) {
	return;
}

if ( ! WC()->cart->is_empty() ) :
	?>
	<div class="woocommerce-form-coupon-toggle mb-6">
		<?php
		wc_print_notice(
			apply_filters(
				'woocommerce_checkout_coupon_message',
				esc_html__( 'Have a coupon?', 'shop-groznet' ) . ' <a href="#" class="showcoupon font-bold underline hover:no-underline">' . esc_html__( 'Click here to enter your code', 'shop-groznet' ) . '</a>'
			),
			'notice'
		);
		?>
	</div>

	<form class="checkout_coupon woocommerce-form-coupon <?php sgz_ui_class( 'panel_tight' ); ?> mb-8 space-y-4" method="post" style="display:none">

		<p class="<?php sgz_ui_class( 'muted' ); ?> m-0"><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'shop-groznet' ); ?></p>

		<div class="flex flex-col sm:flex-row items-stretch gap-3">
			<p class="form-row form-row-first grow m-0">
				<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon code', 'shop-groznet' ); ?></label>
				<input type="text" name="coupon_code" class="input-text <?php sgz_ui_class( 'input' ); ?>" placeholder="<?php esc_attr_e( 'Coupon code', 'shop-groznet' ); ?>" id="coupon_code" value="" />
			</p>

			<p class="form-row form-row-last m-0 shrink-0">
				<button type="submit" class="button <?php sgz_ui_class( 'btn_secondary' ); ?> w-full sm:w-auto" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'shop-groznet' ); ?>">
					<?php esc_html_e( 'Apply coupon', 'shop-groznet' ); ?>
				</button>
			</p>
		</div>

		<div class="clear"></div>
	</form>
	<?php
endif;
