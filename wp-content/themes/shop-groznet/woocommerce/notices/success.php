<?php
/**
 * Success notices.
 *
 * Override of woocommerce/templates/notices/success.php.
 *
 * The "added to cart" message carries a View cart button inside the notice
 * body; assets/css/woocommerce.css gives that button the theme's styling,
 * since it is generated in PHP and cannot take utility classes here.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( ! $notices ) {
	return;
}

foreach ( $notices as $notice ) : ?>
	<div class="woocommerce-message sgz-notice sgz-notice--success flex flex-wrap items-center justify-between gap-4 p-4 mb-6 text-sm rounded-xl bg-brand-50 dark:bg-brand-950/30 border border-brand-200/60 dark:border-brand-800/40 text-brand-800 dark:text-brand-300 leading-relaxed" role="alert" <?php echo function_exists( 'wc_get_notice_data_attr' ) ? wc_get_notice_data_attr( $notice ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
		<?php echo function_exists( 'wc_kses_notice' ) ? wc_kses_notice( $notice['notice'] ) : wp_kses_post( $notice['notice'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</div>
<?php endforeach;
