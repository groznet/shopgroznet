<?php
/**
 * Quantity input.
 *
 * Override of woocommerce/templates/global/quantity-input.php.
 *
 * Shared by the cart, the simple add-to-cart form and the variation form,
 * which is why it is overridden alongside them. The input name, id, min/max,
 * step and the hidden single-quantity variant are preserved; WooCommerce and
 * its AJAX cart read those directly.
 *
 * Args are read defensively so the template keeps working across the
 * WooCommerce versions that added `type`, `readonly` and `placeholder`.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

$sgz_input_id    = isset( $input_id ) ? $input_id : uniqid( 'quantity_' );
$sgz_input_name  = isset( $input_name ) ? $input_name : 'quantity';
$sgz_input_value = isset( $input_value ) ? $input_value : 1;
$sgz_classes     = isset( $classes ) ? $classes : array();
$sgz_min_value   = isset( $min_value ) ? $min_value : 0;
$sgz_max_value   = isset( $max_value ) ? $max_value : '';
$sgz_step        = isset( $step ) ? $step : 1;
$sgz_inputmode   = isset( $inputmode ) ? $inputmode : 'numeric';
$sgz_placeholder = isset( $placeholder ) ? $placeholder : '';
$sgz_readonly    = isset( $readonly ) ? $readonly : false;
$sgz_type        = isset( $type ) ? $type : 'number';
$sgz_autocomplete = isset( $autocomplete ) ? $autocomplete : 'off';

if ( '' !== $sgz_max_value && $sgz_min_value === $sgz_max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden"
			id="<?php echo esc_attr( $sgz_input_id ); ?>"
			class="qty"
			name="<?php echo esc_attr( $sgz_input_name ); ?>"
			value="<?php echo esc_attr( $sgz_min_value ); ?>" />
	</div>
	<?php
} else {
	/* translators: %s: product name. */
	$sgz_label = ! empty( $args['product_name'] )
		? sprintf( esc_html__( '%s quantity', 'shop-groznet' ), wp_strip_all_tags( $args['product_name'] ) )
		: esc_html__( 'Quantity', 'shop-groznet' );
	?>
	<div class="quantity sgz-quantity <?php echo esc_attr( is_array( $sgz_classes ) ? implode( ' ', $sgz_classes ) : $sgz_classes ); ?>">

		<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>

		<label class="screen-reader-text" for="<?php echo esc_attr( $sgz_input_id ); ?>">
			<?php echo esc_html( $sgz_label ); ?>
		</label>

		<input
			type="<?php echo esc_attr( $sgz_type ); ?>"
			id="<?php echo esc_attr( $sgz_input_id ); ?>"
			class="input-text qty text w-20 px-3 py-3 text-sm text-center bg-neutral-50 dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded-xl text-neutral-900 dark:text-white transition focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/30"
			name="<?php echo esc_attr( $sgz_input_name ); ?>"
			value="<?php echo esc_attr( $sgz_input_value ); ?>"
			aria-label="<?php esc_attr_e( 'Product quantity', 'shop-groznet' ); ?>"
			min="<?php echo esc_attr( $sgz_min_value ); ?>"
			max="<?php echo esc_attr( 0 < $sgz_max_value ? $sgz_max_value : '' ); ?>"
			<?php if ( ! $sgz_readonly ) : ?>
				step="<?php echo esc_attr( $sgz_step ); ?>"
				placeholder="<?php echo esc_attr( $sgz_placeholder ); ?>"
				inputmode="<?php echo esc_attr( $sgz_inputmode ); ?>"
				autocomplete="<?php echo esc_attr( $sgz_autocomplete ); ?>"
			<?php else : ?>
				readonly="readonly"
			<?php endif; ?>
		/>

		<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
	</div>
	<?php
}
