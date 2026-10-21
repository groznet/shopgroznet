<?php
/**
 * Login form.
 *
 * Override of woocommerce/templates/global/form-login.php.
 *
 * Used by the checkout login reminder and by My Account. The username and
 * password field names, the login button name and the woocommerce-login
 * nonce are what WC_Form_Handler::process_login() checks, so they are
 * unchanged.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() ) {
	return;
}
?>
<form class="woocommerce-form woocommerce-form-login login <?php sgz_ui_class( 'panel_tight' ); ?> mb-8 space-y-5" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput ?>

	<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first m-0">
			<label for="username" class="<?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Username or email', 'shop-groznet' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text <?php sgz_ui_class( 'input' ); ?>" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; // phpcs:ignore ?>" />
		</p>

		<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last m-0">
			<label for="password" class="<?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Password', 'shop-groznet' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
			<input class="woocommerce-Input woocommerce-Input--text input-text <?php sgz_ui_class( 'input' ); ?>" type="password" name="password" id="password" autocomplete="current-password" />
		</p>
	</div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="flex flex-wrap items-center justify-between gap-4">
		<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme inline-flex items-center gap-3 cursor-pointer text-sm text-neutral-600 dark:text-neutral-400">
			<input class="woocommerce-form__input woocommerce-form__input-checkbox sgz-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
			<span><?php esc_html_e( 'Remember me', 'shop-groznet' ); ?></span>
		</label>

		<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="text-sm font-bold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors">
			<?php esc_html_e( 'Lost your password?', 'shop-groznet' ); ?>
		</a>
	</div>

	<div>
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<button type="submit" class="woocommerce-button button woocommerce-form-login__submit <?php sgz_ui_class( 'btn_primary' ); ?>" name="login" value="<?php esc_attr_e( 'Login', 'shop-groznet' ); ?>">
			<?php esc_html_e( 'Login', 'shop-groznet' ); ?>
		</button>
	</div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
