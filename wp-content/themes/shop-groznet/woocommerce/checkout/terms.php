<?php
/**
 * Terms and conditions checkbox.
 *
 * Override of woocommerce/templates/checkout/terms.php.
 *
 * The #terms checkbox name and the .woocommerce-terms-and-conditions wrapper
 * are validated by checkout.js and by WC_Checkout, so they are unchanged.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( ! apply_filters( 'woocommerce_checkout_show_terms', true ) || ! function_exists( 'wc_terms_and_conditions_checkbox_enabled' ) ) {
	return;
}

if ( ! wc_terms_and_conditions_checkbox_enabled() ) {
	return;
}
?>
<div class="woocommerce-terms-and-conditions-wrapper mb-4">

	<?php
	/**
	 * Terms and conditions hook.
	 *
	 * @hooked wc_checkout_privacy_policy_text - 20
	 * @hooked wc_terms_and_conditions_page_content - 30
	 */
	do_action( 'woocommerce_checkout_before_terms_and_conditions' );
	?>

	<p class="form-row validate-required m-0">
		<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox inline-flex items-start gap-3 cursor-pointer text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
			<input type="checkbox"
				class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox sgz-checkbox mt-0.5 shrink-0"
				name="terms"
				<?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); // phpcs:ignore WordPress.Security.NonceVerification.Missing ?>
				id="terms" />
			<span class="woocommerce-terms-and-conditions-checkbox-text"><?php wc_terms_and_conditions_checkbox_text(); ?></span>&nbsp;
			<span class="required" aria-hidden="true">*</span>
		</label>
		<input type="hidden" name="terms-field" value="1" />
	</p>

	<?php do_action( 'woocommerce_checkout_after_terms_and_conditions' ); ?>

</div>
