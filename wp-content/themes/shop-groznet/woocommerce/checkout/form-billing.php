<?php
/**
 * Checkout billing fields.
 *
 * Override of woocommerce/templates/checkout/form-billing.php.
 *
 * The fields themselves are printed by woocommerce_form_field(), not by this
 * template, so their Tailwind classes come from sgz_form_field_args() in
 * inc/woocommerce.php. Only the headings and wrappers are styled here.
 *
 * The createaccount checkbox keeps its name and #createaccount id: checkout.js
 * toggles the account fields on it.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields space-y-5">

	<div class="space-y-2">
		<h3 class="<?php sgz_ui_class( 'h3' ); ?>">
			<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
				<?php esc_html_e( 'Billing &amp; shipping', 'shop-groznet' ); ?>
			<?php else : ?>
				<?php esc_html_e( 'Billing details', 'shop-groznet' ); ?>
			<?php endif; ?>
		</h3>
		<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>
	</div>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper grid grid-cols-1 sm:grid-cols-2 gap-5">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields space-y-5 pt-2">

		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account m-0">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox inline-flex items-center gap-3 cursor-pointer text-sm text-neutral-600 dark:text-neutral-400">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox sgz-checkbox"
						id="createaccount"
						<?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?>
						type="checkbox" name="createaccount" value="1" />
					<span><?php esc_html_e( 'Create an account?', 'shop-groznet' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>
			<div class="create-account grid grid-cols-1 sm:grid-cols-2 gap-5">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif;
