<?php
/**
 * Single product meta (SKU, categories, tags).
 *
 * Override of woocommerce/templates/single-product/meta.php.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="product_meta pt-5 border-t border-neutral-100 dark:border-neutral-800 space-y-1.5 text-sm text-neutral-500 dark:text-neutral-400">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<span class="sku_wrapper block">
			<?php esc_html_e( 'SKU:', 'shop-groznet' ); ?>
			<span class="sku text-neutral-900 dark:text-white"><?php echo esc_html( $product->get_sku() ? $product->get_sku() : __( 'N/A', 'shop-groznet' ) ); ?></span>
		</span>
	<?php endif; ?>

	<?php
	echo wc_get_product_category_list( // phpcs:ignore WordPress.Security.EscapeOutput
		$product->get_id(),
		', ',
		'<span class="posted_in block">' . esc_html( _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'shop-groznet' ) ) . ' ',
		'</span>'
	);

	echo wc_get_product_tag_list( // phpcs:ignore WordPress.Security.EscapeOutput
		$product->get_id(),
		', ',
		'<span class="tagged_as block">' . esc_html( _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'shop-groznet' ) ) . ' ',
		'</span>'
	);
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
