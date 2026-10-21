<?php
/**
 * Shop GrozNet theme bootstrap.
 *
 * Loads the theme modules. Everything of substance lives in inc/.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme version. Used for cache-busting enqueued assets.
 */
if ( ! defined( 'SGZ_VERSION' ) ) {
	define( 'SGZ_VERSION', '1.0.0' );
}

/**
 * Pinned CDN versions. Changing these here changes them everywhere.
 */
if ( ! defined( 'SGZ_TAILWIND_CDN' ) ) {
	define( 'SGZ_TAILWIND_CDN', 'https://cdn.tailwindcss.com/3.4.16' );
}

if ( ! defined( 'SGZ_ALPINE_CDN' ) ) {
	define( 'SGZ_ALPINE_CDN', 'https://unpkg.com/alpinejs@3.14.8/dist/cdn.min.js' );
}

if ( ! defined( 'SGZ_ALPINE_COLLAPSE_CDN' ) ) {
	define( 'SGZ_ALPINE_COLLAPSE_CDN', 'https://unpkg.com/@alpinejs/collapse@3.14.8/dist/cdn.min.js' );
}

if ( ! defined( 'SGZ_FONTAWESOME_KIT' ) ) {
	define( 'SGZ_FONTAWESOME_KIT', 'https://kit.fontawesome.com/1b1dcc9abc.js' );
}

require_once get_theme_file_path( 'inc/setup.php' );
require_once get_theme_file_path( 'inc/enqueue.php' );
require_once get_theme_file_path( 'inc/template-tags.php' );

/**
 * WooCommerce integration is only loaded when WooCommerce is active, so the
 * theme stays usable (and does not fatal) on a plain WordPress install.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require_once get_theme_file_path( 'inc/woocommerce.php' );
}
