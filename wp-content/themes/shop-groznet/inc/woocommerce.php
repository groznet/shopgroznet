<?php
/**
 * WooCommerce integration.
 *
 * Two rules govern this file:
 *
 * 1. No root-level woocommerce.php. That file would take precedence over
 *    woocommerce/archive-product.php and silently disable the archive
 *    override. Instead the default content wrappers are unhooked and
 *    replaced below, so every WooCommerce page -- including the ones this
 *    theme does not override, like My Account and Order Received -- renders
 *    inside the same page shell.
 *
 * 2. When a template in woocommerce/ renders something itself that
 *    WooCommerce also renders through a hook, the default callback is
 *    unhooked here rather than the do_action() being deleted from the
 *    template. Third-party plugins keep their attachment points.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------------------------
 * Page shell
 * ---------------------------------------------------------------------- */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'sgz_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'sgz_wrapper_end', 10 );

/**
 * Open the theme's main container for WooCommerce pages.
 *
 * Mirrors the shell that header.php + page.php produce for regular content.
 *
 * @return void
 */
function sgz_wrapper_start() {
	printf(
		'<div id="primary" class="%1$s"><div class="%2$s"><main id="main" class="site-main" role="main">',
		esc_attr( sgz_ui( 'section' ) ),
		esc_attr( sgz_ui( 'container' ) )
	);
}

/**
 * Close the theme's main container.
 *
 * @return void
 */
function sgz_wrapper_end() {
	echo '</main></div></div>';
}

/**
 * Opening tag of the breadcrumb <nav>.
 *
 * @param string $extra Extra classes (e.g. a bottom margin).
 * @return string
 */
function sgz_breadcrumb_wrap_before( $extra = '' ) {
	return '<nav class="woocommerce-breadcrumb flex flex-wrap items-center gap-x-2 gap-y-1 text-xs md:text-sm font-medium text-neutral-500 dark:text-neutral-400 ' . esc_attr( $extra ) . '" aria-label="' . esc_attr__( 'Breadcrumb', 'shop-groznet' ) . '">';
}

/**
 * Breadcrumb styling: home icon, chevron separators, bold current page.
 * The markup itself is woocommerce/global/breadcrumb.php.
 *
 * @param array $args Breadcrumb args.
 * @return array
 */
function sgz_breadcrumb_args( $args ) {
	$args['wrap_before'] = sgz_breadcrumb_wrap_before( 'mb-6' );
	$args['wrap_after']  = '</nav>';
	$args['delimiter']   = '<span class="text-neutral-300 dark:text-neutral-700 select-none" aria-hidden="true">' . sgz_icon( 'chevron-right', 'w-3 h-3' ) . '</span>';
	$args['before']      = '';
	$args['after']       = '';
	$args['home']        = 'Главная';

	return $args;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'sgz_breadcrumb_args' );

/**
 * "Главная" points at the main GrozNet site, not this shop.
 *
 * @return string
 */
function sgz_breadcrumb_home_url() {
	return sgz_main_site_url() . '/';
}
add_filter( 'woocommerce_breadcrumb_home_url', 'sgz_breadcrumb_home_url' );

/* -------------------------------------------------------------------------
 * Product loop
 *
 * content-product.php builds the card itself so the image, body and footer
 * can be separate boxes. The callbacks it replaces are unhooked here; the
 * do_action() calls stay in the template.
 * ---------------------------------------------------------------------- */

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

/**
 * Products per row is handled by the Tailwind grid in loop-start.php, but
 * WooCommerce still uses this value for its own classes and for the
 * "columns" loop property.
 *
 * @return int
 */
function sgz_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'sgz_loop_columns' );

/**
 * Products per page on the shop archive.
 *
 * @return int
 */
function sgz_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'sgz_products_per_page', 20 );

/* -------------------------------------------------------------------------
 * Shop filter sidebar (template-parts/shop-filters.php)
 *
 * Category links and the price range (min_price / max_price) are
 * WooCommerce's own query vars, so no custom query handling is needed.
 * ---------------------------------------------------------------------- */

/**
 * Lowest and highest product price, rounded out to whole currency units.
 *
 * @return array{0:int,1:int}
 */
function sgz_price_bounds() {
	global $wpdb;

	static $bounds = null;

	if ( null === $bounds ) {
		$row    = $wpdb->get_row( "SELECT FLOOR( MIN( min_price ) ) AS lo, CEIL( MAX( max_price ) ) AS hi FROM {$wpdb->wc_product_meta_lookup}" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$bounds = array( $row ? (int) $row->lo : 0, $row ? (int) $row->hi : 0 );
	}

	return $bounds;
}

/**
 * "In stock only" filter (?in_stock=1) on the main product query.
 *
 * @param WP_Query $q Product query.
 * @return void
 */
function sgz_in_stock_query( $q ) {
	if ( empty( $_GET['in_stock'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return;
	}

	$meta_query   = (array) $q->get( 'meta_query' );
	$meta_query[] = array(
		'key'   => '_stock_status',
		'value' => 'instock',
	);

	$q->set( 'meta_query', $meta_query );
}
add_action( 'woocommerce_product_query', 'sgz_in_stock_query' );

/**
 * Archive URL without pagination, with the current query args merged with
 * $args. A false value drops that arg.
 *
 * @param array $args Query args to set.
 * @return string
 */
function sgz_shop_url( $args = array() ) {
	$base = is_product_taxonomy() ? get_term_link( get_queried_object() ) : wc_get_page_permalink( 'shop' );

	if ( is_search() ) {
		$base = home_url( '/' );
	}

	$current = array_diff_key( wc_clean( wp_unslash( $_GET ) ), array( 'paged' => 1, 'product-page' => 1 ) ); // phpcs:ignore WordPress.Security.NonceVerification

	return add_query_arg( array_merge( $current, $args ), $base );
}

/**
 * Related products: 4 per row.
 *
 * @param array $args Related product args.
 * @return array
 */
function sgz_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'sgz_related_products_args' );

/**
 * Sale flash text is rendered by the overridden sale-flash templates.
 *
 * @param string $html Placeholder image HTML.
 * @return string
 */
function sgz_placeholder_img( $html ) {
	return str_replace(
		'<img',
		'<img data-sgz-placeholder="1"',
		$html
	);
}
add_filter( 'woocommerce_placeholder_img', 'sgz_placeholder_img' );

/* -------------------------------------------------------------------------
 * Single product
 * ---------------------------------------------------------------------- */

/**
 * Give the single product summary title the theme's display style.
 *
 * WooCommerce prints this heading from a PHP function rather than a template,
 * so the classes are filtered rather than typed into markup.
 *
 * @return void
 */
function sgz_single_title() {
	the_title( '<h1 class="product_title entry-title ' . esc_attr( sgz_ui( 'h1' ) ) . '">', '</h1>' );
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'sgz_single_title', 5 );

/**
 * Wrap the short description so it picks up the body copy style.
 *
 * @return void
 */
function sgz_single_excerpt() {
	global $post;

	if ( ! $post || ! $post->post_excerpt ) {
		return;
	}

	echo '<div class="woocommerce-product-details__short-description ' . esc_attr( sgz_ui( 'body' ) ) . '">';
	echo wp_kses_post( apply_filters( 'woocommerce_short_description', $post->post_excerpt ) );
	echo '</div>';
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'sgz_single_excerpt', 20 );

/* -------------------------------------------------------------------------
 * Mini-cart buttons
 *
 * cart/mini-cart.php renders its own View cart / Checkout buttons so they can
 * carry the theme's button classes. The defaults are unhooked; the
 * woocommerce_widget_shopping_cart_buttons action itself is preserved.
 * ---------------------------------------------------------------------- */

remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

/* -------------------------------------------------------------------------
 * Form fields
 *
 * Checkout and account fields are generated by woocommerce_form_field(), not
 * by a template, so the only way to put Tailwind classes on them is this
 * filter.
 * ---------------------------------------------------------------------- */

/**
 * Apply the theme's form control styling to WooCommerce form fields.
 *
 * @param array  $args Field args.
 * @param string $key  Field key.
 * @param mixed  $value Field value.
 * @return array
 */
function sgz_form_field_args( $args, $key, $value ) {

	$args['label_class'] = array_merge(
		(array) ( isset( $args['label_class'] ) ? $args['label_class'] : array() ),
		explode( ' ', sgz_ui( 'label' ) )
	);

	$control = 'input';

	if ( isset( $args['type'] ) ) {
		if ( 'select' === $args['type'] || 'state' === $args['type'] || 'country' === $args['type'] ) {
			$control = 'select';
		} elseif ( 'textarea' === $args['type'] ) {
			$control = 'textarea';
		}
	}

	if ( isset( $args['type'] ) && 'checkbox' === $args['type'] ) {
		$args['input_class'] = array_merge(
			(array) ( isset( $args['input_class'] ) ? $args['input_class'] : array() ),
			array( 'sgz-checkbox' )
		);
	} else {
		$args['input_class'] = array_merge(
			(array) ( isset( $args['input_class'] ) ? $args['input_class'] : array() ),
			explode( ' ', sgz_ui( $control ) )
		);
	}

	$args['class'] = array_merge(
		(array) ( isset( $args['class'] ) ? $args['class'] : array() ),
		array( 'sgz-form-row' )
	);

	return $args;
}
add_filter( 'woocommerce_form_field_args', 'sgz_form_field_args', 10, 3 );

/**
 * Style the quantity input.
 *
 * @param array      $args    Quantity input args.
 * @param WC_Product $product Product object.
 * @return array
 */
function sgz_quantity_input_args( $args, $product ) {
	$args['classes'] = array_merge(
		(array) ( isset( $args['classes'] ) ? $args['classes'] : array() ),
		array( 'sgz-qty' )
	);

	return $args;
}
add_filter( 'woocommerce_quantity_input_args', 'sgz_quantity_input_args', 10, 2 );

/**
 * Style the "Place order" button, which WooCommerce prints from PHP.
 *
 * @param string $html Button HTML.
 * @return string
 */
function sgz_order_button_html( $html ) {
	return str_replace(
		'class="button alt',
		'class="' . esc_attr( sgz_ui( 'btn_primary' ) ) . ' w-full mt-2 button alt',
		$html
	);
}
add_filter( 'woocommerce_order_button_html', 'sgz_order_button_html' );

/* -------------------------------------------------------------------------
 * Cart fragments
 *
 * WooCommerce refreshes these over AJAX after add-to-cart and quantity
 * changes, so the header count and the drawer contents update without a
 * page reload. Selectors must match elements that exist in the DOM.
 * ---------------------------------------------------------------------- */

/**
 * Render the header cart count badge.
 *
 * @return void
 */
function sgz_cart_count_badge() {
	$count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;

	printf(
		'<span class="sgz-cart-count absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 flex items-center justify-center rounded-full bg-brand-600 text-white text-[10px] font-bold %1$s">%2$s</span>',
		esc_attr( $count > 0 ? '' : 'hidden' ),
		esc_html( $count )
	);
}

/**
 * Render the drawer body (the mini-cart itself).
 *
 * @return void
 */
function sgz_cart_drawer_contents() {
	echo '<div id="sgz-cart-drawer-contents" class="sgz-mini-cart flex-1 overflow-y-auto px-6 py-6">';
	woocommerce_mini_cart();
	echo '</div>';
}

/**
 * Register the fragments.
 *
 * @param array $fragments Fragments keyed by selector.
 * @return array
 */
function sgz_cart_fragments( $fragments ) {

	ob_start();
	sgz_cart_count_badge();
	$fragments['span.sgz-cart-count'] = ob_get_clean();

	ob_start();
	sgz_cart_drawer_contents();
	$fragments['#sgz-cart-drawer-contents'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'sgz_cart_fragments' );

/**
 * Print the cart drawer once per page, at the end of <body>.
 *
 * Kept out of header.php so the drawer markup sits above everything in the
 * stacking order without needing a z-index arms race.
 *
 * @return void
 */
function sgz_render_cart_drawer() {

	if ( ! function_exists( 'WC' ) || is_admin() ) {
		return;
	}

	get_template_part( 'template-parts/cart-drawer' );
}
add_action( 'wp_footer', 'sgz_render_cart_drawer' );

/* -------------------------------------------------------------------------
 * Misc
 * ---------------------------------------------------------------------- */

/**
 * Remove the default WooCommerce sidebar on shop pages unless the widget
 * area actually has widgets.
 *
 * @return void
 */
function sgz_maybe_remove_sidebar() {
	if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}
add_action( 'wp', 'sgz_maybe_remove_sidebar' );

/**
 * Move cross-sells out of the cart totals column.
 *
 * By default woocommerce_cross_sell_display runs on
 * woocommerce_cart_collaterals, which in this layout is the narrow sticky
 * column beside the cart. Re-hooking it onto woocommerce_after_cart lets
 * cross-sells use the full-width three-up grid instead.
 *
 * @return void
 */
function sgz_move_cross_sells() {
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 10 );
}
add_action( 'wp', 'sgz_move_cross_sells' );

/**
 * Cross-sells use the same three-up grid as the shop archive.
 *
 * @param int $columns Column count.
 * @return int
 */
function sgz_cross_sells_columns( $columns ) {
	return 3;
}
add_filter( 'woocommerce_cross_sells_columns', 'sgz_cross_sells_columns' );

/**
 * Cross-sell count, matching the grid.
 *
 * @param int $total Number of cross-sells.
 * @return int
 */
function sgz_cross_sells_total( $total ) {
	return 3;
}
add_filter( 'woocommerce_cross_sells_total', 'sgz_cross_sells_total' );
