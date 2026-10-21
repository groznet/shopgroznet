<?php
/**
 * Variation add-to-cart button and quantity.
 *
 * Override of woocommerce/templates/single-product/add-to-cart/variation-add-to-cart-button.php.
 *
 * The three hidden inputs (add-to-cart, product_id, variation_id) and the
 * .woocommerce-variation-add-to-cart / .variations_button class names are what
 * add-to-cart-variation.js writes the selected variation into. They are
 * reproduced verbatim; adding to cart silently fails without them.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button flex flex-wrap items-stretch gap-3 pt-2">

	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			// phpcs:ignore WordPress.Security.NonceVerification.Missing
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
		),
		$product
	);

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

	<button type="submit" class="single_add_to_cart_button button alt <?php sgz_ui_class( 'btn_primary' ); ?> grow sm:grow-0">
		<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
	</button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
