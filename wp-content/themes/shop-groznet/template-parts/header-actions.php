<?php
/**
 * Header actions: dark theme toggle, account link and cart button.
 *
 * Printed twice by header.php -- in the middle bar from lg up and in the
 * navigation bar below that -- and hidden with CSS at the other breakpoint.
 * Both cart buttons carry .sgz-cart-toggle and the count badge fragment, so
 * WooCommerce's fragment refresh updates them together.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

$sgz_btn = 'sgz-header-action inline-flex items-center justify-center p-2 rounded-lg text-gray-600 dark:text-neutral-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500';
?>
<button type="button" class="sgz-color-scheme-toggle <?php echo esc_attr( $sgz_btn ); ?>"
	aria-label="<?php esc_attr_e( 'Toggle dark theme', 'shop-groznet' ); ?>"
	aria-pressed="false">
	<span class="block dark:hidden"><?php echo sgz_icon( 'moon', 'w-5 h-5' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
	<span class="hidden dark:block"><?php echo sgz_icon( 'sun', 'w-5 h-5' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
</button>

<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
	<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"
		class="<?php echo esc_attr( $sgz_btn ); ?> hidden sm:inline-flex"
		aria-label="<?php esc_attr_e( 'My account', 'shop-groznet' ); ?>">
		<?php echo sgz_icon( 'user', 'w-5 h-5' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</a>

	<button type="button"
		class="sgz-cart-toggle relative <?php echo esc_attr( $sgz_btn ); ?>"
		@click="$store.sgz.openCart()"
		:aria-expanded="$store.sgz.cartOpen ? 'true' : 'false'"
		aria-controls="sgz-cart-drawer"
		aria-label="<?php esc_attr_e( 'Open cart', 'shop-groznet' ); ?>">
		<?php
		echo sgz_icon( 'cart', 'w-5 h-5' ); // phpcs:ignore WordPress.Security.EscapeOutput
		sgz_cart_count_badge();
		?>
	</button>
<?php endif; ?>

