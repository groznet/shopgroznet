<?php
add_action( 'after_setup_theme', 'theme_slug_setup' );

function theme_slug_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

function groznet_enqueue_assets()
{
    wp_enqueue_style(
        'groznet-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        filemtime(
            get_template_directory() . '/assets/css/main.css'
        )
    );

    wp_enqueue_script(
        'tailwind-config',
        get_template_directory_uri() . '/assets/js/tailwind-config.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'tailwind',
        get_template_directory_uri() . '/assets/js/tailwind.js',
        ['tailwind-config'],
        null,
        true
    );

    wp_enqueue_script(
        'groznet-main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['tailwind'],
        null,
        true
    );
}

add_action(
    'wp_enqueue_scripts',
    'groznet_enqueue_assets'
);

// Disable default WooCommerce CSS
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Filter WooCommerce checkout/form fields to inject Tailwind CSS classes
 */
add_filter( 'woocommerce_form_field_args', 'groznet_woocommerce_form_field_args', 10, 3 );
function groznet_woocommerce_form_field_args( $args, $key, $value ) {
    $args['class'][] = 'mb-4';
    $args['label_class'][] = 'block text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300 mb-1.5';

    switch ( $args['type'] ) {
        case 'select':
        case 'country':
        case 'state':
            $args['input_class'][] = 'w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all cursor-pointer';
            break;
        case 'checkbox':
            $args['input_class'][] = 'rounded border-neutral-300 dark:border-neutral-700 text-blue-600 focus:ring-blue-500 h-4 w-4 mr-2';
            $args['label_class'] = ['inline-flex items-center text-sm text-neutral-600 dark:text-neutral-400 cursor-pointer'];
            break;
        case 'textarea':
            $args['input_class'][] = 'w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all placeholder-neutral-400 min-h-[100px]';
            break;
        default:
            $args['input_class'][] = 'w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all placeholder-neutral-400';
            break;
    }

    return $args;
}

/**
 * Filter WooCommerce loop add to cart button class
 */
add_filter( 'woocommerce_loop_add_to_cart_args', 'groznet_loop_add_to_cart_args', 10, 2 );
function groznet_loop_add_to_cart_args( $args, $product ) {
    $args['class'] = implode(
        ' ',
        array_filter( array(
            'button',
            $product->is_type( 'variable' ) ? 'product_type_variable' : '',
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
            'w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 text-white font-semibold text-sm hover:bg-blue-700 transition-all shadow-sm hover:shadow-md'
        ) )
    );
    return $args;
}