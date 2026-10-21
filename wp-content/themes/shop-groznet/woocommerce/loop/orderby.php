<?php
/**
 * Catalogue ordering dropdown.
 *
 * Override of woocommerce/templates/loop/orderby.php.
 *
 * Field name (orderby), the paged hidden field and wc_query_string_form_fields()
 * are preserved exactly -- ordering breaks without them.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
<form class="woocommerce-ordering flex items-center gap-3 m-0" method="get">
	<div class="relative">
		<select name="orderby" id="sgz-orderby" class="orderby <?php sgz_ui_class( 'select' ); ?> !w-auto !py-2 !pl-3 !pr-9"
			aria-label="<?php esc_attr_e( 'Shop order', 'shop-groznet' ); ?>">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<span class="absolute inset-y-0 right-2.5 flex items-center pointer-events-none text-neutral-400">
			<?php echo sgz_icon( 'chevron-down', 'w-4 h-4' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</span>
	</div>

	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
