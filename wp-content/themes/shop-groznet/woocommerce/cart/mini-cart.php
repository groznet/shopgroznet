<?php
/**
 * Mini-cart (cart drawer contents).
 *
 * Override of woocommerce/templates/cart/mini-cart.php.
 *
 * Printed by woocommerce_mini_cart() from sgz_cart_drawer_contents() in
 * inc/woocommerce.php, which also registers the wrapper as a cart fragment.
 * WooCommerce re-renders this template over AJAX after every add-to-cart or
 * removal, so the drawer and the header count stay in sync without a reload.
 *
 * Preserved verbatim because wc-cart-fragments.js and woocommerce.js bind to
 * them: the .remove_from_cart_button class, data-product_id,
 * data-cart_item_key and data-product_sku attributes, and the
 * .woocommerce-mini-cart* class names.
 *
 * The View cart / Checkout callbacks are unhooked in inc/woocommerce.php so
 * the buttons below can carry the theme's button classes; the
 * woocommerce_widget_shopping_cart_buttons action itself is preserved.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_mini_cart.
 */
do_action( 'woocommerce_before_mini_cart' );
?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( isset( $args['list_class'] ) ? $args['list_class'] : '' ); ?> list-none p-0 m-0 divide-y divide-neutral-100 dark:divide-neutral-800">
		<?php
		/**
		 * Hook: woocommerce_before_mini_cart_contents.
		 */
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail', array( 'class' => 'w-16 h-16 object-cover object-center rounded-xl bg-neutral-100 dark:bg-neutral-800' ) ), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?> flex items-start gap-4 py-4">

					<?php if ( empty( $product_permalink ) ) : ?>
						<span class="shrink-0"><?php echo wp_kses_post( $thumbnail ); ?></span>
					<?php else : ?>
						<a href="<?php echo esc_url( $product_permalink ); ?>" class="shrink-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 rounded-xl">
							<?php echo wp_kses_post( $thumbnail ); ?>
						</a>
					<?php endif; ?>

					<div class="grow min-w-0 space-y-1">
						<?php if ( empty( $product_permalink ) ) : ?>
							<span class="block text-sm font-bold text-neutral-900 dark:text-white"><?php echo wp_kses_post( $product_name ); ?></span>
						<?php else : ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>" class="block text-sm font-bold text-neutral-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 rounded">
								<?php echo wp_kses_post( $product_name ); ?>
							</a>
						<?php endif; ?>

						<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput ?>

						<span class="quantity block text-sm text-neutral-500 dark:text-neutral-400">
							<?php
							printf(
								'%s &times; %s',
								esc_html( $cart_item['quantity'] ),
								wp_kses_post( $product_price )
							);
							?>
						</span>
					</div>

					<?php
					echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a href="%s" class="remove remove_from_cart_button shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-lg text-neutral-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">%s</a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							/* translators: %s: product name. */
							esc_attr( sprintf( __( 'Remove %s from cart', 'shop-groznet' ), wp_strip_all_tags( $product_name ) ) ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() ),
							sgz_icon( 'trash', 'w-4 h-4' )
						),
						$cart_item_key
					);
					?>
				</li>
				<?php
			}
		}

		/**
		 * Hook: woocommerce_mini_cart_contents.
		 */
		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>

	<div class="sgz-mini-cart__footer mt-6 pt-5 border-t border-neutral-100 dark:border-neutral-800 space-y-4">

		<p class="woocommerce-mini-cart__total total flex items-baseline justify-between gap-4 m-0">
			<?php
			/**
			 * Hook: woocommerce_widget_shopping_cart_total.
			 *
			 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
			 */
			do_action( 'woocommerce_widget_shopping_cart_total' );
			?>
		</p>

		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_before_buttons.
		 */
		do_action( 'woocommerce_widget_shopping_cart_before_buttons' );
		?>

		<p class="woocommerce-mini-cart__buttons buttons flex flex-col gap-3 m-0">
			<?php
			/**
			 * Hook: woocommerce_widget_shopping_cart_buttons.
			 *
			 * @hooked woocommerce_widget_shopping_cart_button_view_cart - 10 (unhooked in inc/woocommerce.php)
			 * @hooked woocommerce_widget_shopping_cart_proceed_to_checkout - 20 (unhooked in inc/woocommerce.php)
			 */
			do_action( 'woocommerce_widget_shopping_cart_buttons' );
			?>

			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward <?php sgz_ui_class( 'btn_primary' ); ?> w-full">
				<?php esc_html_e( 'Checkout', 'shop-groznet' ); ?>
				<?php echo sgz_icon( 'arrow-right', 'w-4 h-4' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</a>

			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward <?php sgz_ui_class( 'btn_secondary' ); ?> w-full">
				<?php esc_html_e( 'View cart', 'shop-groznet' ); ?>
			</a>
		</p>
	</div>

<?php else : ?>

	<div class="woocommerce-mini-cart__empty-message text-center py-12 space-y-4">
		<div class="w-14 h-14 mx-auto flex items-center justify-center rounded-2xl bg-neutral-100 dark:bg-neutral-800 text-neutral-400">
			<?php echo sgz_icon( 'cart', 'w-7 h-7' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
		<p class="<?php sgz_ui_class( 'muted' ); ?> m-0"><?php esc_html_e( 'No products in the cart.', 'shop-groznet' ); ?></p>
		<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="<?php sgz_ui_class( 'btn_ghost' ); ?>">
				<?php esc_html_e( 'Browse the shop', 'shop-groznet' ); ?>
				<?php echo sgz_icon( 'arrow-right', 'w-4 h-4' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</a>
		<?php endif; ?>
	</div>

<?php endif; ?>

<?php
/**
 * Hook: woocommerce_after_mini_cart.
 */
do_action( 'woocommerce_after_mini_cart' );
