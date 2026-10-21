<?php
/**
 * Result count on the shop archive.
 *
 * Override of woocommerce/templates/loop/result-count.php.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( 1 === (int) $total ) {
	$sgz_text = __( 'Showing the single result', 'shop-groznet' );
} elseif ( $total <= $per_page || -1 === $per_page ) {
	/* translators: %d: total results. */
	$sgz_text = sprintf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'shop-groznet' ), $total );
} else {
	$sgz_first = ( $per_page * $current ) - $per_page + 1;
	$sgz_last  = min( $total, $per_page * $current );

	/* translators: 1: first result, 2: last result, 3: total results. */
	$sgz_text = sprintf(
		_nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'shop-groznet' ),
		$sgz_first,
		$sgz_last,
		$total
	);
}
?>
<p class="woocommerce-result-count <?php sgz_ui_class( 'muted' ); ?> m-0">
	<?php echo esc_html( wp_strip_all_tags( $sgz_text ) ); ?>
</p>
