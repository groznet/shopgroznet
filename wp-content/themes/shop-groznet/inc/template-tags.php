<?php
/**
 * Template helpers and the shared class-token map.
 *
 * Every recurring visual element in the theme resolves its Tailwind classes
 * through sgz_ui(). The strings below are lifted from the GrozNet static
 * site; change one here and every template, WooCommerce override and AJAX
 * fragment follows.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class tokens.
 *
 * @param string $key Token name.
 * @return string Space-separated Tailwind classes.
 */
function sgz_ui( $key ) {

	$map = array(

		// Layout ------------------------------------------------------------
		'container'        => 'container',
		'section'          => 'py-16 md:py-20 bg-white dark:bg-neutral-900 transition-colors duration-300',
		'section_alt'      => 'py-16 md:py-20 bg-neutral-50 dark:bg-neutral-950 transition-colors duration-300',

		// Typography --------------------------------------------------------
		'eyebrow'          => 'text-xs font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400',
		'h1'               => 'text-3xl md:text-5xl font-serif font-bold text-neutral-900 dark:text-white tracking-tight',
		'h2'               => 'text-3xl md:text-4xl font-serif font-bold text-neutral-900 dark:text-white tracking-tight',
		'h3'               => 'text-lg font-serif font-bold text-neutral-900 dark:text-white',
		'rule'             => 'h-1 w-12 bg-brand-600 rounded-full',
		'body'             => 'text-base md:text-lg text-neutral-600 dark:text-neutral-400 leading-relaxed',
		'muted'            => 'text-sm text-neutral-500 dark:text-neutral-400',

		// Buttons -----------------------------------------------------------
		'btn_primary'      => 'inline-flex items-center justify-center gap-2 px-6 py-3.5 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 rounded-xl shadow-md active:scale-98 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-brand-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-neutral-900',
		'btn_primary_sm'   => 'inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 rounded-xl shadow-md active:scale-98 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-neutral-900',
		'btn_secondary'    => 'inline-flex items-center justify-center gap-2 px-6 py-3.5 text-sm font-bold text-neutral-900 dark:text-white bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-xl active:scale-98 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-neutral-900',
		'btn_ghost'        => 'inline-flex items-center gap-2 text-base font-bold text-neutral-600 dark:text-neutral-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors group focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 rounded-lg',
		'btn_icon'         => 'inline-flex items-center justify-center p-3 rounded-xl bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-neutral-600 dark:text-neutral-400 hover:text-brand-600 dark:hover:text-brand-400 hover:shadow-lg transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500',

		// Surfaces ----------------------------------------------------------
		'panel'            => 'bg-white dark:bg-neutral-900 border border-neutral-200/60 dark:border-neutral-800/60 p-8 rounded-2xl shadow-sm',
		'panel_tight'      => 'bg-white dark:bg-neutral-900 border border-neutral-200/60 dark:border-neutral-800/60 p-6 rounded-2xl shadow-sm',
		'card'             => 'group relative overflow-hidden rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900 shadow-sm hover:shadow-xl dark:hover:shadow-neutral-950/40 transition-all duration-300 flex flex-col',
		'card_soft'        => 'group p-8 rounded-2xl border border-neutral-100 dark:border-neutral-800 bg-neutral-50/50 dark:bg-neutral-900/50 hover:bg-white dark:hover:bg-neutral-800 hover:border-brand-500/30 dark:hover:border-brand-500/30 hover:shadow-xl dark:hover:shadow-neutral-950/50 transition-all duration-300',
		'divider'          => 'border-neutral-100 dark:border-neutral-800',

		// Forms -------------------------------------------------------------
		'label'            => 'block text-xs font-semibold text-neutral-600 dark:text-neutral-400 uppercase tracking-wider mb-1.5',
		'input'            => 'w-full px-4 py-3 text-sm bg-neutral-50 dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded-xl text-neutral-900 dark:text-white transition focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/30',
		'select'           => 'w-full px-4 py-3 text-sm bg-neutral-50 dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded-xl text-neutral-900 dark:text-white transition appearance-none focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/30',
		'textarea'         => 'w-full px-4 py-3 text-sm bg-neutral-50 dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded-xl text-neutral-900 dark:text-white transition resize-none focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/30',

		// Notices -----------------------------------------------------------
		'notice'           => 'p-4 text-sm rounded-xl bg-amber-50 dark:bg-amber-950/20 border border-amber-200/60 dark:border-amber-800/40 text-amber-800 dark:text-amber-400 leading-relaxed',

		// Commerce ----------------------------------------------------------
		'price'            => 'text-lg font-bold text-neutral-900 dark:text-white',
		'price_lg'         => 'text-2xl md:text-3xl font-bold text-neutral-900 dark:text-white',
		'badge'            => 'inline-flex items-center px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-brand-600 text-white shadow-md',
		'tab_active'       => 'bg-brand-600 text-white shadow-md',
		'tab_idle'         => 'text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white',
		'tablist'          => 'flex flex-wrap gap-2 bg-neutral-200/60 dark:bg-neutral-900/40 p-1.5 rounded-xl border border-neutral-200/10',
		'tab'              => 'px-5 py-2 text-sm font-medium rounded-lg transition-all duration-200 whitespace-nowrap focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500',
	);

	/**
	 * Filter the class-token map.
	 *
	 * @param array  $map Token map.
	 * @param string $key Requested token.
	 */
	$map = apply_filters( 'sgz_ui_classes', $map, $key );

	return isset( $map[ $key ] ) ? $map[ $key ] : '';
}

/**
 * Echo a class token.
 *
 * @param string $key   Token name.
 * @param string $extra Extra classes appended.
 * @return void
 */
function sgz_ui_class( $key, $extra = '' ) {
	echo esc_attr( trim( sgz_ui( $key ) . ' ' . $extra ) );
}

/**
 * Post/page pagination, styled to match the site.
 *
 * @return void
 */
function sgz_pagination() {

	$links = paginate_links(
		array(
			'type'      => 'array',
			'mid_size'  => 1,
			'prev_text' => esc_html__( 'Previous', 'shop-groznet' ),
			'next_text' => esc_html__( 'Next', 'shop-groznet' ),
		)
	);

	if ( empty( $links ) ) {
		return;
	}

	echo '<nav class="sgz-pagination flex justify-center mt-12" aria-label="' . esc_attr__( 'Pagination', 'shop-groznet' ) . '">';
	echo '<div class="flex flex-wrap items-center gap-2">';

	foreach ( $links as $link ) {
		echo wp_kses_post( $link );
	}

	echo '</div></nav>';
}

/**
 * Entry meta for blog posts.
 *
 * @return void
 */
function sgz_entry_meta() {
	printf(
		'<div class="%1$s">%2$s <time datetime="%3$s">%4$s</time></div>',
		esc_attr( sgz_ui( 'muted' ) ),
		esc_html__( 'Published', 'shop-groznet' ),
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);
}

/**
 * SVG icon set.
 *
 * Inline SVG keeps icons theme-coloured (currentColor) and avoids the
 * icon-font request. Paths are the Heroicons outline set used by the
 * static site.
 *
 * @param string $name    Icon name.
 * @param string $classes Classes for the <svg> element.
 * @return string
 */
function sgz_icon( $name, $classes = 'w-5 h-5' ) {

	$paths = array(
		'arrow-right' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />',
		'chevron-down' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />',
		'chevron-left' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />',
		'chevron-right' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />',
		'cart'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />',
		'search'      => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />',
		'menu'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />',
		'close'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />',
		'sun'         => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />',
		'moon'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />',
		'trash'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.2v.916m7.5 0a48.667 48.667 0 00-7.5 0" />',
		'check'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />',
		'home'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />',
		'user'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="%1$s" aria-hidden="true" focusable="false">%2$s</svg>',
		esc_attr( $classes ),
		$paths[ $name ] // phpcs:ignore WordPress.Security.EscapeOutput -- static markup.
	);
}

/**
 * Allow inline SVG through wp_kses when icons are passed through filters.
 *
 * @param array $tags Allowed tags.
 * @return array
 */
function sgz_kses_allow_svg( $tags ) {
	$tags['svg']  = array(
		'xmlns'        => true,
		'fill'         => true,
		'viewbox'      => true,
		'stroke'       => true,
		'stroke-width' => true,
		'class'        => true,
		'aria-hidden'  => true,
		'focusable'    => true,
		'width'        => true,
		'height'       => true,
	);
	$tags['path'] = array(
		'd'               => true,
		'stroke-linecap'  => true,
		'stroke-linejoin' => true,
		'fill'            => true,
		'fill-rule'       => true,
		'clip-rule'       => true,
	);

	return $tags;
}
add_filter( 'wp_kses_allowed_html', 'sgz_kses_allow_svg', 10, 1 );

/**
 * Put the theme's classes on navigation links.
 *
 * wp_nav_menu() builds the <a> elements, so this filter is the only place
 * Tailwind classes can be attached without shipping a custom walker.
 *
 * @param array    $atts  Link attributes.
 * @param WP_Post  $item  Menu item.
 * @param stdClass $args  wp_nav_menu arguments.
 * @param int      $depth Depth of the item.
 * @return array
 */
function sgz_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

	if ( empty( $args->theme_location ) ) {
		return $atts;
	}

	$classes = '';

	if ( 'primary' === $args->theme_location ) {
		$classes = 0 === (int) $depth
			? 'inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium rounded-lg text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500'
			: 'block px-3 py-2 text-sm font-medium rounded-lg text-neutral-600 dark:text-neutral-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500';
	} elseif ( 'footer' === $args->theme_location ) {
		$classes = 'hover:text-brand-600 dark:hover:text-brand-400 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 rounded';
	}

	if ( $classes ) {
		$atts['class'] = trim( ( isset( $atts['class'] ) ? $atts['class'] : '' ) . ' ' . $classes );
	}

	/*
	 * Sub-menus open on hover and on :focus-within (see assets/css/theme.css),
	 * so aria-haspopup is accurate. aria-expanded is deliberately not set:
	 * without JS driving it, it would report a state that is not true. The
	 * toggles that do have real open/closed state -- search, mobile menu, cart
	 * drawer -- carry aria-expanded in header.php.
	 */
	if ( in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
		$atts['aria-haspopup'] = 'true';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'sgz_nav_menu_link_attributes', 10, 4 );

/**
 * Classes for sub-menu <ul> elements.
 *
 * @param array    $classes Sub-menu classes.
 * @param stdClass $args    wp_nav_menu arguments.
 * @param int      $depth   Depth.
 * @return array
 */
function sgz_nav_menu_submenu_css_class( $classes, $args, $depth ) {

	if ( ! empty( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$classes[] = 'sgz-sub-menu';
	}

	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'sgz_nav_menu_submenu_css_class', 10, 3 );

/**
 * Header image from assets/images/, or a Font Awesome icon until the file is
 * copied into the theme.
 *
 * @param string $file    Path inside assets/images/.
 * @param string $fa      Font Awesome class used as the fallback.
 * @param string $alt     Alt text.
 * @param string $classes Classes for the <img>.
 * @param string $width   Width attribute / CSS size of the fallback icon.
 * @return string
 */
function sgz_header_image( $file, $fa, $alt, $classes = '', $width = '35' ) {

	if ( file_exists( get_theme_file_path( 'assets/images/' . $file ) ) ) {
		return sprintf(
			'<img src="%1$s" alt="%2$s" class="%3$s"%4$s>',
			esc_url( get_theme_file_uri( 'assets/images/' . $file ) ),
			esc_attr( $alt ),
			esc_attr( $classes ),
			is_numeric( $width ) ? ' width="' . (int) $width . '"' : ''
		);
	}

	return sprintf( '<i class="fa %1$s text-3xl opacity-60" role="img" aria-label="%2$s"></i>', esc_attr( $fa ), esc_attr( $alt ) );
}

/**
 * Inline style for a header column separator image, desktop only; empty if
 * the file is not in assets/images/.
 *
 * @param string $file Path inside assets/images/.
 * @return string
 */
function sgz_header_bg( $file ) {

	if ( ! file_exists( get_theme_file_path( 'assets/images/' . $file ) ) ) {
		return '';
	}

	return sprintf( 'style="--sgz-bg:url(\'%s\')"', esc_url( get_theme_file_uri( 'assets/images/' . $file ) ) );
}

/**
 * Base URL of the main GrozNet site (no trailing slash).
 *
 * @return string
 */
function sgz_main_site_url() {
	return untrailingslashit( apply_filters( 'sgz_main_site_url', 'https://groznet.com' ) );
}
