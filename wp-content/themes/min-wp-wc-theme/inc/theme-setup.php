<?php
/**
 * Core theme setup: supports, menus, sidebars, assets.
 */

defined( 'ABSPATH' ) || exit;

function min_setup() {
	load_theme_textdomain( 'min', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'customize-selective-refresh-widgets' );
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
			'navigation-widgets',
		)
	);

	// Gallery zoom/slider/lightbox support is deliberately left out: the
	// plain stacked-image fallback needs no extra JS or CSS and fits the
	// HTML-first approach better.
	if ( class_exists( 'WooCommerce' ) ) {
		add_theme_support( 'woocommerce' );
	}

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'min' ),
			'footer'  => __( 'Footer Menu', 'min' ),
		)
	);

	$GLOBALS['content_width'] = 720;
}
add_action( 'after_setup_theme', 'min_setup' );

function min_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'min' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Widgets', 'min' ),
			'id'            => 'footer-widgets',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'min_widgets_init' );

function min_scripts() {
	wp_enqueue_style( 'min-style', get_stylesheet_uri(), array(), MIN_THEME_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'min_scripts' );
