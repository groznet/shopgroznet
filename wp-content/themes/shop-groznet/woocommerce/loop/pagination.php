<?php
/**
 * Product archive pagination.
 *
 * Override of woocommerce/templates/loop/pagination.php.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>
<nav class="woocommerce-pagination sgz-pagination flex justify-center mt-12" aria-label="<?php esc_attr_e( 'Product pagination', 'shop-groznet' ); ?>">
	<div class="flex flex-wrap items-center gap-2">
		<?php
		echo paginate_links( // phpcs:ignore WordPress.Security.EscapeOutput
			apply_filters(
				'woocommerce_pagination_args',
				array(
					'base'      => $base,
					'format'    => $format,
					'add_args'  => false,
					'current'   => max( 1, $current ),
					'total'     => $total,
					'prev_text' => esc_html__( 'Previous', 'shop-groznet' ),
					'next_text' => esc_html__( 'Next', 'shop-groznet' ),
					'type'      => 'plain',
					'end_size'  => 3,
					'mid_size'  => 3,
				)
			)
		);
		?>
	</div>
</nav>
