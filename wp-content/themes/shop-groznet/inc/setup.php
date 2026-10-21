<?php
/**
 * Theme setup: supports, menus, sidebars, translations.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/**
 * Core theme setup.
 *
 * Runs on after_setup_theme, which is where add_theme_support() and
 * load_theme_textdomain() belong.
 *
 * @return void
 */
function sgz_setup() {

	// Translations. Domain Path in style.css is /languages, so is this.
	load_theme_textdomain( 'shop-groznet', get_theme_file_path( 'languages' ) );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 48,
			'width'       => 180,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * WooCommerce support. Template overrides in the theme's woocommerce/
	 * folder are only honoured when the theme declares this support --
	 * without it WooCommerce falls back to shortcode-based "unsupported
	 * theme" rendering and every override in this theme is ignored.
	 */
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 600,
			'single_image_width'    => 1200,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);

	// Product gallery: slider, zoom and lightbox on the single product image.
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary menu', 'shop-groznet' ),
			'footer'  => esc_html__( 'Footer menu', 'shop-groznet' ),
		)
	);

	// Editor: mirror the front-end container width from the static site.
	add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'sgz_setup' );

/**
 * Content width, matching the static site's 1280px container.
 *
 * @return void
 */
function sgz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sgz_content_width', 1280 );
}
add_action( 'after_setup_theme', 'sgz_content_width', 0 );

/**
 * Register widget areas.
 *
 * @return void
 */
function sgz_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop sidebar', 'shop-groznet' ),
			'id'            => 'shop-sidebar',
			'description'   => esc_html__( 'Shown beside product archives.', 'shop-groznet' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s mb-8 p-6 rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900 shadow-sm">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-lg font-serif font-bold text-neutral-900 dark:text-white mb-4">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer widgets', 'shop-groznet' ),
			'id'            => 'footer-widgets',
			'description'   => esc_html__( 'Shown in the site footer.', 'shop-groznet' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-sm font-bold uppercase tracking-widest text-neutral-900 dark:text-white mb-4">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'sgz_widgets_init' );

/**
 * Add the dark-mode class hook and a stable page-shell class to <body>.
 *
 * @param array $classes Body classes.
 * @return array
 */
function sgz_body_class( $classes ) {
	$classes[] = 'sgz-body';
	$classes[] = 'bg-white';
	$classes[] = 'dark:bg-neutral-900';
	$classes[] = 'text-neutral-600';
	$classes[] = 'dark:text-neutral-400';
	$classes[] = 'font-sans';
	$classes[] = 'antialiased';

	return $classes;
}
add_filter( 'body_class', 'sgz_body_class' );

/**
 * Excerpt length, tuned for the product/post card body copy.
 *
 * @param int $length Default length.
 * @return int
 */
function sgz_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'sgz_excerpt_length' );

/**
 * Excerpt ellipsis.
 *
 * @return string
 */
function sgz_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'sgz_excerpt_more' );
