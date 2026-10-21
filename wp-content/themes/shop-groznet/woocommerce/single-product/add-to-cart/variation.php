<?php
/**
 * Variation JS templates.
 *
 * Override of woocommerce/templates/single-product/add-to-cart/variation.php.
 *
 * These are Underscore templates, not markup: add-to-cart-variation.js renders
 * them into .single_variation whenever the shopper picks a combination, which
 * is where the dynamic price, availability and description come from. The
 * script looks the templates up by the exact ids below -- renaming either one
 * leaves the price area permanently blank.
 *
 * Styling has to live inside the templates because the markup is injected by
 * JS after Tailwind's first pass; the runtime picks the classes up on the
 * mutation observer.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
<script type="text/template" id="tmpl-variation-template">
	<div class="woocommerce-variation-description text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">{{{ data.variation.variation_description }}}</div>
	<div class="woocommerce-variation-price text-2xl md:text-3xl font-bold text-neutral-900 dark:text-white">{{{ data.variation.price_html }}}</div>
	<div class="woocommerce-variation-availability text-sm font-medium text-neutral-500 dark:text-neutral-400">{{{ data.variation.availability_html }}}</div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p role="alert" class="<?php echo esc_attr( sgz_ui( 'notice' ) ); ?>">
		<?php esc_html_e( 'Sorry, this product is unavailable. Please choose a different combination.', 'shop-groznet' ); ?>
	</p>
</script>
