<?php
/**
 * Checkout form.
 *
 * Override of woocommerce/templates/checkout/form-checkout.php.
 *
 * IMPORTANT: this template is used when the checkout page contains the
 * [woocommerce_checkout] shortcode (the "classic" checkout). Stores using the
 * Checkout *block* render from block markup instead and ignore this file --
 * see the README.
 *
 * The ids customer_details, order_review and order_review_heading are read by
 * WooCommerce's checkout.js to place the AJAX-refreshed order review and to
 * scroll to validation errors, so they are reproduced exactly, as are the form
 * name, method, action and enctype.
 *
 * Layout is the static site's two-column contact section: form fields on the
 * left, a sticky summary panel on the right.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_checkout_form.
 *
 * @hooked woocommerce_checkout_login_form - 10
 * @hooked woocommerce_checkout_coupon_form - 10
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo '<div class="' . esc_attr( sgz_ui( 'notice' ) ) . '">';
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'shop-groznet' ) ) );
	echo '</div>';
	return;
}
?>

<form name="checkout"
	method="post"
	class="checkout woocommerce-checkout grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start"
	action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
	enctype="multipart/form-data"
	aria-label="<?php echo esc_attr__( 'Checkout', 'shop-groznet' ); ?>">

	<div class="lg:col-span-7 space-y-8">

		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set <?php sgz_ui_class( 'panel' ); ?> space-y-8" id="customer_details">

				<div class="col-1">
					<?php
					/**
					 * Hook: woocommerce_checkout_billing.
					 *
					 * @hooked WC_Checkout::checkout_form_billing() - 10
					 */
					do_action( 'woocommerce_checkout_billing' );
					?>
				</div>

				<div class="col-2">
					<?php
					/**
					 * Hook: woocommerce_checkout_shipping.
					 *
					 * @hooked WC_Checkout::checkout_form_shipping() - 10
					 */
					do_action( 'woocommerce_checkout_shipping' );
					?>
				</div>

			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>

	</div>

	<div class="lg:col-span-5">

		<div class="lg:sticky lg:top-28 space-y-4">

			<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

			<h3 id="order_review_heading" class="<?php sgz_ui_class( 'h3' ); ?>">
				<?php esc_html_e( 'Your order', 'shop-groznet' ); ?>
			</h3>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order <?php sgz_ui_class( 'panel_tight' ); ?>">
				<?php
				/**
				 * Hook: woocommerce_checkout_order_review.
				 *
				 * @hooked woocommerce_order_review - 10
				 * @hooked woocommerce_checkout_payment - 20
				 */
				do_action( 'woocommerce_checkout_order_review' );
				?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

		</div>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout );
