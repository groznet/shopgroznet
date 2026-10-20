<?php
/**
 * The sidebar.
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside aria-label="<?php esc_attr_e( 'Sidebar', 'min' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
