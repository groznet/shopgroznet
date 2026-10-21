<?php
/**
 * Shown when a product query returns nothing.
 *
 * Override of woocommerce/templates/loop/no-products-found.php.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="<?php sgz_ui_class( 'panel' ); ?> woocommerce-info max-w-2xl mx-auto text-center space-y-5">
	<h2 class="<?php sgz_ui_class( 'h3' ); ?>"><?php esc_html_e( 'No products found', 'shop-groznet' ); ?></h2>
	<p class="<?php sgz_ui_class( 'muted' ); ?>">
		<?php esc_html_e( 'Nothing matched this request. Try a different search or browse the whole catalogue.', 'shop-groznet' ); ?>
	</p>
	<div class="max-w-md mx-auto"><?php get_search_form(); ?></div>
	<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
		<a class="<?php sgz_ui_class( 'btn_primary' ); ?>" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
			<?php esc_html_e( 'Back to shop', 'shop-groznet' ); ?>
		</a>
	<?php endif; ?>
</div>
