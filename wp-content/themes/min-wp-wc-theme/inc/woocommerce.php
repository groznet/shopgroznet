<?php
/**
 * WooCommerce integration.
 */

defined( 'ABSPATH' ) || exit;

/**
 * The theme provides its own single stylesheet; WooCommerce's bundled
 * CSS (layout, buttons, star ratings, etc.) is not needed on top of it.
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
