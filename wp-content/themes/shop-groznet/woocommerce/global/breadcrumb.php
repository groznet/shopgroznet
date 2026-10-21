<?php
/**
 * Breadcrumb.
 *
 * Override of woocommerce/templates/global/breadcrumb.php: home icon on the
 * first crumb, current page as bold text. Wrapper, delimiter and the crumbs
 * themselves still come from woocommerce_breadcrumb() and its filters.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/*
 * WooCommerce generates no trail at all on the page that is also the front
 * page, which is the shop here: give it "Главная > Магазин".
 */
if ( empty( $breadcrumb ) && is_shop() && ! is_paged() ) {
	$breadcrumb = array(
		array( 'Главная', apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) ),
		array( 'Магазин', '' ),
	);
}

if ( empty( $breadcrumb ) ) {
	return;
}

echo wp_kses_post( $wrap_before );

$sgz_last = count( $breadcrumb ) - 1;

foreach ( $breadcrumb as $key => $crumb ) {
	echo wp_kses_post( $before );

	if ( ! empty( $crumb[1] ) && $key !== $sgz_last ) {
		echo '<a href="' . esc_url( $crumb[1] ) . '" class="inline-flex items-center gap-1.5 hover:text-brand-600 dark:hover:text-brand-400 transition-colors duration-200">';

		if ( 0 === $key ) {
			echo sgz_icon( 'home', 'w-3.5 h-3.5' ); // phpcs:ignore WordPress.Security.EscapeOutput
		}

		echo esc_html( $crumb[0] ) . '</a>';
	} else {
		echo '<span class="text-neutral-700 dark:text-neutral-200 font-semibold">' . esc_html( $crumb[0] ) . '</span>';
	}

	echo wp_kses_post( $after );

	if ( $key !== $sgz_last ) {
		echo wp_kses_post( $delimiter );
	}
}

echo wp_kses_post( $wrap_after );
