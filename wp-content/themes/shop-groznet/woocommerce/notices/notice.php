<?php
/**
 * Informational notices.
 *
 * Override of woocommerce/templates/notices/notice.php.
 *
 * Uses the amber notice styling from the static site's contact form.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( ! $notices ) {
	return;
}

foreach ( $notices as $notice ) : ?>
	<div class="woocommerce-info sgz-notice sgz-notice--info flex flex-wrap items-center justify-between gap-4 mb-6 <?php sgz_ui_class( 'notice' ); ?>" <?php echo function_exists( 'wc_get_notice_data_attr' ) ? wc_get_notice_data_attr( $notice ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
		<?php echo function_exists( 'wc_kses_notice' ) ? wc_kses_notice( $notice['notice'] ) : wp_kses_post( $notice['notice'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</div>
<?php endforeach;
