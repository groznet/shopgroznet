<?php
/**
 * Search form.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

$sgz_field_id = 'sgz-search-' . wp_unique_id();
?>
<form role="search" method="get" class="sgz-search-form flex items-stretch gap-2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only screen-reader-text" for="<?php echo esc_attr( $sgz_field_id ); ?>">
		<?php esc_html_e( 'Search for:', 'shop-groznet' ); ?>
	</label>
	<input type="search"
		id="<?php echo esc_attr( $sgz_field_id ); ?>"
		class="<?php sgz_ui_class( 'input' ); ?>"
		placeholder="<?php esc_attr_e( 'Search products&hellip;', 'shop-groznet' ); ?>"
		value="<?php echo esc_attr( get_search_query() ); ?>"
		name="s" />
	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<input type="hidden" name="post_type" value="product" />
	<?php endif; ?>
	<button type="submit" class="<?php sgz_ui_class( 'btn_primary' ); ?> shrink-0">
		<?php echo sgz_icon( 'search', 'w-4 h-4' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<span class="hidden sm:inline"><?php esc_html_e( 'Search', 'shop-groznet' ); ?></span>
	</button>
</form>
