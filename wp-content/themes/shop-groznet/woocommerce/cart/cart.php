<?php
/**
 * Cart page.
 *
 * Override of woocommerce/templates/cart/cart.php.
 *
 * The static site has no cart page, so the styling is derived from its
 * existing components: the contact panel supplies the surface (rounded-2xl,
 * hairline border, shadow-sm), the contact form supplies the control styles,
 * and the portfolio card supplies the thumbnail treatment.
 *
 * Preserved verbatim because WooCommerce reads them directly:
 *   - the cart[{key}][qty] input names (built by woocommerce_quantity_input)
 *   - the update_cart and apply_coupon button names
 *   - the woocommerce-cart nonce and its woocommerce-cart-nonce field name
 *   - the .woocommerce-cart-form / .cart_item / .qty class names used by cart.js
 *
 * The table stacks into rows on small screens using Tailwind's block/table-cell
 * utilities plus a visually duplicated label per cell, which is why the
 * shop_table_responsive stylesheet is not needed.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_cart.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_cart' );
?>

<div class="sgz-cart grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

	<div class="lg:col-span-8">

		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

			<?php
			/**
			 * Hook: woocommerce_before_cart_table.
			 */
			do_action( 'woocommerce_before_cart_table' );
			?>

			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full border-collapse" cellspacing="0">

				<thead class="hidden md:table-header-group">
					<tr class="border-b border-neutral-200/60 dark:border-neutral-800/60">
						<th class="product-remove sr-only"><span class="screen-reader-text"><?php esc_html_e( 'Remove item', 'shop-groznet' ); ?></span></th>
						<th class="product-thumbnail sr-only"><span class="screen-reader-text"><?php esc_html_e( 'Thumbnail image', 'shop-groznet' ); ?></span></th>
						<th class="product-name text-left pb-4 <?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Product', 'shop-groznet' ); ?></th>
						<th class="product-price text-left pb-4 <?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Price', 'shop-groznet' ); ?></th>
						<th class="product-quantity text-left pb-4 <?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Quantity', 'shop-groznet' ); ?></th>
						<th class="product-subtotal text-right pb-4 <?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Subtotal', 'shop-groznet' ); ?></th>
					</tr>
				</thead>

				<tbody class="block md:table-row-group">

					<?php
					/**
					 * Hook: woocommerce_before_cart_contents.
					 */
					do_action( 'woocommerce_before_cart_contents' );

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> block md:table-row relative border-b border-neutral-100 dark:border-neutral-800 py-5 md:py-0">

								<td class="product-remove block absolute top-5 right-0 md:static md:table-cell md:py-5 md:pr-3 align-middle">
									<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove inline-flex items-center justify-center w-8 h-8 rounded-lg text-neutral-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											/* translators: %s: product name. */
											esc_attr( sprintf( __( 'Remove %s from cart', 'shop-groznet' ), wp_strip_all_tags( $_product->get_name() ) ) ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() ),
											sgz_icon( 'trash', 'w-4 h-4' )
										),
										$cart_item_key
									);
									?>
								</td>

								<td class="product-thumbnail block mb-3 md:mb-0 md:table-cell md:py-5 md:pr-4 align-middle">
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail', array( 'class' => 'w-20 h-20 md:w-16 md:h-16 object-cover object-center rounded-xl bg-neutral-100 dark:bg-neutral-800' ) ), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo wp_kses_post( $thumbnail );
									} else {
										printf( '<a href="%s" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 rounded-xl">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
									}
									?>
								</td>

								<td class="product-name block mb-2 md:mb-0 md:table-cell md:py-5 md:pr-4 align-middle" data-title="<?php esc_attr_e( 'Product', 'shop-groznet' ); ?>">
									<?php
									if ( ! $product_permalink ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
									} else {
										echo wp_kses_post(
											apply_filters(
												'woocommerce_cart_item_name',
												sprintf(
													'<a href="%s" class="font-serif font-bold text-neutral-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 rounded">%s</a>',
													esc_url( $product_permalink ),
													esc_html( $_product->get_name() )
												),
												$cart_item,
												$cart_item_key
											)
										);
									}

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

									// Meta data.
									echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput

									// Backorder notification.
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification ' . esc_attr( sgz_ui( 'muted' ) ) . '">' . esc_html__( 'Available on backorder', 'shop-groznet' ) . '</p>', $product_id ) );
									}
									?>
								</td>

								<td class="product-price block mb-2 md:mb-0 md:table-cell md:py-5 md:pr-4 align-middle" data-title="<?php esc_attr_e( 'Price', 'shop-groznet' ); ?>">
									<span class="md:hidden <?php sgz_ui_class( 'label' ); ?> mb-0"><?php esc_html_e( 'Price', 'shop-groznet' ); ?></span>
									<span class="text-sm text-neutral-600 dark:text-neutral-400">
										<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
									</span>
								</td>

								<td class="product-quantity block mb-2 md:mb-0 md:table-cell md:py-5 md:pr-4 align-middle" data-title="<?php esc_attr_e( 'Quantity', 'shop-groznet' ); ?>">
									<?php
									if ( $_product->is_sold_individually() ) {
										$min_quantity = 1;
										$max_quantity = 1;
									} else {
										$min_quantity = 0;
										$max_quantity = $_product->get_max_purchase_quantity();
									}

									$product_quantity = woocommerce_quantity_input(
										array(
											'input_name'   => "cart[{$cart_item_key}][qty]",
											'input_value'  => $cart_item['quantity'],
											'max_value'    => $max_quantity,
											'min_value'    => $min_quantity,
											'product_name' => $_product->get_name(),
										),
										$_product,
										false
									);

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput
									?>
								</td>

								<td class="product-subtotal block mb-2 md:mb-0 md:table-cell md:py-5 md:text-right align-middle" data-title="<?php esc_attr_e( 'Subtotal', 'shop-groznet' ); ?>">
									<span class="md:hidden <?php sgz_ui_class( 'label' ); ?> mb-0"><?php esc_html_e( 'Subtotal', 'shop-groznet' ); ?></span>
									<span class="font-bold text-neutral-900 dark:text-white">
										<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
									</span>
								</td>

							</tr>
							<?php
						}
					}

					/**
					 * Hook: woocommerce_cart_contents.
					 */
					do_action( 'woocommerce_cart_contents' );
					?>

					<tr class="block md:table-row">
						<td colspan="6" class="actions block md:table-cell pt-6">

							<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

								<?php if ( wc_coupons_enabled() ) { ?>
									<div class="coupon flex items-stretch gap-2 w-full sm:max-w-sm">
										<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon code', 'shop-groznet' ); ?></label>
										<input type="text"
											name="coupon_code"
											class="input-text <?php sgz_ui_class( 'input' ); ?>"
											id="coupon_code"
											value=""
											placeholder="<?php esc_attr_e( 'Coupon code', 'shop-groznet' ); ?>" />
										<button type="submit"
											class="button <?php sgz_ui_class( 'btn_secondary' ); ?> shrink-0 whitespace-nowrap"
											name="apply_coupon"
											value="<?php esc_attr_e( 'Apply coupon', 'shop-groznet' ); ?>">
											<?php esc_html_e( 'Apply', 'shop-groznet' ); ?>
										</button>

										<?php do_action( 'woocommerce_cart_coupon' ); ?>
									</div>
								<?php } ?>

								<button type="submit"
									class="button <?php sgz_ui_class( 'btn_secondary' ); ?> shrink-0"
									name="update_cart"
									value="<?php esc_attr_e( 'Update cart', 'shop-groznet' ); ?>">
									<?php esc_html_e( 'Update cart', 'shop-groznet' ); ?>
								</button>

								<?php do_action( 'woocommerce_cart_actions' ); ?>

								<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
							</div>
						</td>
					</tr>

					<?php
					/**
					 * Hook: woocommerce_after_cart_contents.
					 */
					do_action( 'woocommerce_after_cart_contents' );
					?>
				</tbody>
			</table>

			<?php
			/**
			 * Hook: woocommerce_after_cart_table.
			 */
			do_action( 'woocommerce_after_cart_table' );
			?>
		</form>
	</div>

	<div class="lg:col-span-4">
		<?php
		/**
		 * Hook: woocommerce_before_cart_collaterals.
		 */
		do_action( 'woocommerce_before_cart_collaterals' );
		?>

		<div class="cart-collaterals lg:sticky lg:top-28 space-y-8">
			<?php
			/**
			 * Hook: woocommerce_cart_collaterals.
			 *
			 * @hooked woocommerce_cross_sell_display - 10
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>
	</div>

</div>

<?php
/**
 * Hook: woocommerce_after_cart.
 */
do_action( 'woocommerce_after_cart' );
