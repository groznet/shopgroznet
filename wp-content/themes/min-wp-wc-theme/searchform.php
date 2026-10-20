<?php
/**
 * The search form.
 */

defined( 'ABSPATH' ) || exit;
?>
<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field"><?php esc_html_e( 'Search for:', 'min' ); ?></label>
	<input type="search" id="search-field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">
	<button type="submit"><?php esc_html_e( 'Search', 'min' ); ?></button>
</form>
