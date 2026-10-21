<?php
/**
 * Shop sidebar.
 *
 * Rendered through the woocommerce_sidebar hook. inc/woocommerce.php unhooks
 * that callback when the widget area is empty, so the shop goes full width
 * unless widgets are actually assigned.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area mt-16" role="complementary">
	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
		<?php dynamic_sidebar( 'shop-sidebar' ); ?>
	</div>
</aside>
