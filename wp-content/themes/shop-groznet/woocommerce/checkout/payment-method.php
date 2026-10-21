<?php
/**
 * A single payment method row.
 *
 * Override of woocommerce/templates/checkout/payment-method.php.
 *
 * The input id (payment_method_{id}), the payment_method radio name and the
 * .payment_box.payment_method_{id} wrapper are what checkout.js shows, hides
 * and validates, so they are unchanged. Styling is the static site's select
 * control treatment, promoted to a selectable card.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?> rounded-xl border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-950 p-4 transition-colors duration-200 hover:border-brand-500/50">

	<label class="flex items-center gap-3 cursor-pointer text-sm font-medium text-neutral-900 dark:text-white" for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
		<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>"
			type="radio"
			class="input-radio sgz-radio shrink-0"
			name="payment_method"
			value="<?php echo esc_attr( $gateway->id ); ?>"
			<?php checked( $gateway->chosen, true ); ?>
			data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
		<span class="grow"><?php echo wp_kses_post( $gateway->get_title() ); ?></span>
		<?php echo wp_kses_post( $gateway->get_icon() ); ?>
	</label>

	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?> mt-3 pt-3 border-t border-neutral-200/60 dark:border-neutral-800/60 text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>
