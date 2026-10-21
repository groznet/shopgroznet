<?php
/**
 * Checkout login reminder.
 *
 * Override of woocommerce/templates/checkout/form-login.php.
 *
 * The .showlogin link toggles the hidden login form rendered by
 * woocommerce_login_form() (global/form-login.php), so it is preserved.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}
?>
<div class="woocommerce-form-login-toggle mb-6">
	<?php
	wc_print_notice(
		apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'shop-groznet' ) ) . ' <a href="#" class="showlogin font-bold underline hover:no-underline">' . esc_html__( 'Click here to login', 'shop-groznet' ) . '</a>',
		'notice'
	);
	?>
</div>

<?php
woocommerce_login_form(
	array(
		'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'shop-groznet' ),
		'redirect' => wc_get_checkout_url(),
		'hidden'   => true,
	)
);
