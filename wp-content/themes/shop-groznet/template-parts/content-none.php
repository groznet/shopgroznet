<?php
/**
 * Shown when a query returns nothing.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="<?php sgz_ui_class( 'panel' ); ?> max-w-2xl mx-auto text-center space-y-5">
	<h2 class="<?php sgz_ui_class( 'h3' ); ?>"><?php esc_html_e( 'Nothing found', 'shop-groznet' ); ?></h2>
	<p class="<?php sgz_ui_class( 'muted' ); ?>">
		<?php esc_html_e( 'We could not find anything matching your request. Try different wording or browse the shop.', 'shop-groznet' ); ?>
	</p>
	<div class="max-w-md mx-auto"><?php get_search_form(); ?></div>
</div>
