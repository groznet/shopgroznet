<?php
/**
 * Error notices.
 *
 * Override of woocommerce/templates/notices/error.php.
 *
 * Overridden because WooCommerce's own stylesheet is dequeued (see
 * inc/enqueue.php), so notices need the theme's own surface. The
 * .woocommerce-error class name and the notice data attributes are preserved:
 * checkout.js scrolls to them and re-renders them over AJAX.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( ! $notices ) {
	return;
}
?>
<ul class="woocommerce-error sgz-notice sgz-notice--error list-none p-4 pl-5 m-0 mb-6 space-y-1 text-sm rounded-xl bg-red-50 dark:bg-red-950/20 border border-red-200/60 dark:border-red-800/40 text-red-800 dark:text-red-400 leading-relaxed" role="alert">
	<?php foreach ( $notices as $notice ) : ?>
		<li <?php echo function_exists( 'wc_get_notice_data_attr' ) ? wc_get_notice_data_attr( $notice ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
			<?php echo function_exists( 'wc_kses_notice' ) ? wc_kses_notice( $notice['notice'] ) : wp_kses_post( $notice['notice'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</li>
	<?php endforeach; ?>
</ul>
