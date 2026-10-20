<?php
/**
 * Theme bootstrap.
 */

defined( 'ABSPATH' ) || exit;

define( 'MIN_THEME_VERSION', '1.0.0' );

require get_theme_file_path( 'inc/theme-setup.php' );
require get_theme_file_path( 'inc/template-functions.php' );

if ( class_exists( 'WooCommerce' ) ) {
	require get_theme_file_path( 'inc/woocommerce.php' );
}
