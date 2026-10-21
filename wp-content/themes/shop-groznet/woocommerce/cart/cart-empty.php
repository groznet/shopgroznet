<?php
/**
 * Empty cart page.
 *
 * Override of woocommerce/templates/cart/cart-empty.php.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_cart_is_empty.
 */
do_action( 'woocommerce_cart_is_empty' );
?>

<div class="cart-empty woocommerce-info max-w-xl mx-auto text-center py-10 space-y-6">

	<div class="w-16 h-16 mx-auto flex items-center justify-center rounded-2xl bg-brand-50 dark:bg-brand-950/50 text-brand-600 dark:text-brand-400">
		<?php echo sgz_icon( 'cart', 'w-8 h-8' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</div>

	<h2 class="<?php sgz_ui_class( 'h2' ); ?>"><?php esc_html_e( 'Your cart is currently empty', 'shop-groznet' ); ?></h2>

	<p class="<?php sgz_ui_class( 'body' ); ?>">
		<?php esc_html_e( 'Browse the catalogue and add something you like — it will show up here.', 'shop-groznet' ); ?>
	</p>

	<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
		<p class="return-to-shop">
			<a class="button wc-backward <?php sgz_ui_class( 'btn_primary' ); ?>" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'Return to shop', 'shop-groznet' ) ) ); ?>
				<?php echo sgz_icon( 'arrow-right', 'w-4 h-4' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</a>
		</p>
	<?php endif; ?>

</div>
