<?php
/**
 * Variable product add-to-cart form.
 *
 * Override of woocommerce/templates/single-product/add-to-cart/variable.php.
 *
 * WooCommerce's add-to-cart-variation.js binds to this markup, so the
 * following are reproduced exactly and must not be renamed: the
 * .variations_form class on the form, data-product_id and
 * data-product_variations, the .variations container holding the selects,
 * the .reset_variations link, and the .single_variation_wrap element.
 * The default table layout is replaced by a stacked field layout; the class
 * names the script queries are untouched.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' );
?>

<form class="variations_form cart sgz-variations-form space-y-5"
	action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
	method="post"
	enctype="multipart/form-data"
	data-product_id="<?php echo absint( $product->get_id() ); ?>"
	data-product_variations="<?php echo $variations_attr; // phpcs:ignore WordPress.Security.EscapeOutput ?>">

	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>

		<p class="stock out-of-stock <?php sgz_ui_class( 'notice' ); ?>">
			<?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'shop-groznet' ) ) ); ?>
		</p>

	<?php else : ?>

		<div class="variations space-y-4">
			<?php foreach ( $attributes as $attribute_name => $options ) : ?>
				<div class="sgz-variation-row">
					<label class="<?php sgz_ui_class( 'label' ); ?>" for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
						<?php echo esc_html( wc_attribute_label( $attribute_name ) ); ?>
					</label>

					<div class="value relative">
						<?php
						wc_dropdown_variation_attribute_options(
							array(
								'options'   => $options,
								'attribute' => $attribute_name,
								'product'   => $product,
							)
						);
						?>
						<span class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-neutral-400">
							<?php echo sgz_icon( 'chevron-down', 'w-4 h-4' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						</span>
					</div>

					<?php
					if ( end( $attribute_keys ) === $attribute_name ) {
						echo wp_kses_post(
							apply_filters(
								'woocommerce_reset_variations_link',
								'<a class="reset_variations inline-flex items-center mt-2 text-xs font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors" href="#">' . esc_html__( 'Clear', 'shop-groznet' ) . '</a>'
							)
						);
					}
					?>
				</div>
			<?php endforeach; ?>
		</div>

		<?php do_action( 'woocommerce_after_variations_table' ); ?>

		<div class="single_variation_wrap">
			<?php
			/**
			 * Hook: woocommerce_before_single_variation.
			 */
			do_action( 'woocommerce_before_single_variation' );

			/**
			 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
			 *
			 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
			 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
			 */
			do_action( 'woocommerce_single_variation' );

			/**
			 * Hook: woocommerce_after_single_variation.
			 */
			do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
