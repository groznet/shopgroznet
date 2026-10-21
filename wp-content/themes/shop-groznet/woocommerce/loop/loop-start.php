<?php
/**
 * Product loop wrapper (opening).
 *
 * Override of woocommerce/templates/loop/loop-start.php.
 *
 * Needed because the grid lives on this element: without the override the
 * cards from content-product.php would sit in WooCommerce's float-based
 * ul.products and the archive would not match the static site's 3-up grid.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

// Narrower content column beside the shop filters: 3-up only from xl.
$cols = wc_get_loop_prop( 'sgz_filters' ) ? 'md:grid-cols-2 xl:grid-cols-3' : 'md:grid-cols-2 lg:grid-cols-3';

// Related products (4 columns) get a fourth column from lg.
if ( 4 === (int) wc_get_loop_prop( 'columns' ) && ! wc_get_loop_prop( 'sgz_filters' ) ) {
	$cols = 'md:grid-cols-2 lg:grid-cols-4';
}
?>
<ul class="products grid grid-cols-1 <?php echo esc_attr( $cols ); ?> gap-8 list-none p-0 m-0 columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
