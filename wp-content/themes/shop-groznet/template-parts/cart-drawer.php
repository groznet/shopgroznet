<?php
/**
 * Cart drawer (mini-cart slide-over).
 *
 * Printed once per page on wp_footer from inc/woocommerce.php. The contents
 * div is registered as a cart fragment, so WooCommerce refreshes it over
 * AJAX after every add-to-cart without a page reload.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'WC' ) ) {
	return;
}
?>
<div id="sgz-cart-drawer-root" x-data x-cloak>

	<div x-show="$store.sgz.cartOpen"
		x-transition:enter="transition-opacity ease-out duration-300"
		x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100"
		x-transition:leave="transition-opacity ease-in duration-200"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0"
		@click="$store.sgz.closeCart()"
		class="fixed inset-0 z-50 bg-neutral-950/50 backdrop-blur-sm"
		aria-hidden="true"></div>

	<div id="sgz-cart-drawer"
		x-show="$store.sgz.cartOpen"
		x-transition:enter="transition-transform ease-out duration-300"
		x-transition:enter-start="translate-x-full"
		x-transition:enter-end="translate-x-0"
		x-transition:leave="transition-transform ease-in duration-200"
		x-transition:leave-start="translate-x-0"
		x-transition:leave-end="translate-x-full"
		@keydown.escape.window="$store.sgz.closeCart()"
		class="fixed top-0 right-0 z-50 h-full w-full max-w-md flex flex-col bg-white dark:bg-neutral-900 border-l border-neutral-200/60 dark:border-neutral-800/60 shadow-xl"
		role="dialog"
		aria-modal="true"
		aria-labelledby="sgz-cart-drawer-title">

		<div class="flex items-center justify-between gap-4 px-6 py-5 border-b border-neutral-100 dark:border-neutral-800">
			<h2 id="sgz-cart-drawer-title" class="<?php sgz_ui_class( 'h3' ); ?>">
				<?php esc_html_e( 'Your cart', 'shop-groznet' ); ?>
			</h2>
			<button type="button"
				class="sgz-cart-close p-2 rounded-xl text-neutral-500 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500"
				@click="$store.sgz.closeCart()"
				aria-label="<?php esc_attr_e( 'Close cart', 'shop-groznet' ); ?>">
				<?php echo sgz_icon( 'close', 'w-5 h-5' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</button>
		</div>

		<?php sgz_cart_drawer_contents(); ?>

	</div>
</div>
