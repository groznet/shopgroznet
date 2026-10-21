<?php
/**
 * Shop filters: categories, tags and price range (sorting lives in the toolbar).
 *
 * Plain GET links and one GET form using WooCommerce's own query vars
 * (product_cat archives, min_price, max_price, orderby), so native filtering,
 * pagination and layered-nav widgets keep working. Below lg the panel is
 * collapsed behind a toggle.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

list( $price_lo, $price_hi ) = sgz_price_bounds();

$categories = get_terms(
	array(
		'taxonomy'     => 'product_cat',
		'hide_empty'   => true,
		'exclude'      => array( (int) get_option( 'default_product_cat' ) ),
		'orderby'      => 'name',
		'hierarchical' => true,
	)
);

$tags = get_terms(
	array(
		'taxonomy'   => 'product_tag',
		'hide_empty' => true,
		'orderby'    => 'name',
	)
);

$current_tag = is_product_tag() ? (int) get_queried_object_id() : 0;
$current_cat = is_product_category() ? (int) get_queried_object_id() : 0;

$min_set = isset( $_GET['min_price'] ) ? max( $price_lo, (int) $_GET['min_price'] ) : $price_lo; // phpcs:ignore WordPress.Security.NonceVerification
$max_set = isset( $_GET['max_price'] ) ? min( $price_hi, (int) $_GET['max_price'] ) : $price_hi; // phpcs:ignore WordPress.Security.NonceVerification

$link      = 'block py-1.5 text-sm text-neutral-600 dark:text-neutral-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors';
$link_on   = 'font-bold text-neutral-900 dark:text-white';
$group     = 'py-6 border-t ' . sgz_ui( 'divider' );
$filtering = isset( $_GET['min_price'] ) || isset( $_GET['max_price'] ); // phpcs:ignore WordPress.Security.NonceVerification
?>
<aside class="sgz-shop-filters mb-8 lg:mb-0" x-data="{ open: false }" aria-label="<?php esc_attr_e( 'Shop filters', 'shop-groznet' ); ?>">

	<button type="button" class="<?php sgz_ui_class( 'btn_secondary', 'w-full lg:hidden' ); ?>"
		@click="open = !open" :aria-expanded="open" aria-controls="sgz-shop-filters-panel">
		<?php esc_html_e( 'Filters', 'shop-groznet' ); ?>
	</button>

	<div id="sgz-shop-filters-panel" class="hidden lg:block mt-2 lg:mt-0" :class="open ? 'block' : 'hidden lg:block'">

		<?php if ( ! is_wp_error( $categories ) && $categories ) : ?>
			<nav class="pb-6" aria-label="<?php esc_attr_e( 'Product categories', 'shop-groznet' ); ?>">
				<h2 class="<?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Categories', 'shop-groznet' ); ?></h2>
				<ul class="list-none m-0 p-0">
					<li>
						<a class="<?php echo esc_attr( $link . ( ! $current_cat ? ' ' . $link_on : '' ) ); ?>" href="<?php echo esc_url( add_query_arg( array_diff_key( wc_clean( wp_unslash( $_GET ) ), array( 'paged' => 1 ) ), wc_get_page_permalink( 'shop' ) ) ); // phpcs:ignore WordPress.Security.NonceVerification ?>">
							<?php esc_html_e( 'All products', 'shop-groznet' ); ?>
						</a>
					</li>
					<?php foreach ( $categories as $cat ) : ?>
						<li <?php echo $cat->parent ? 'class="pl-4"' : ''; ?>>
							<a class="<?php echo esc_attr( $link . ( $current_cat === $cat->term_id ? ' ' . $link_on : '' ) ); ?>"
								href="<?php echo esc_url( add_query_arg( array_diff_key( wc_clean( wp_unslash( $_GET ) ), array( 'paged' => 1 ) ), get_term_link( $cat ) ) ); // phpcs:ignore WordPress.Security.NonceVerification ?>"
								<?php echo $current_cat === $cat->term_id ? 'aria-current="page"' : ''; ?>>
								<?php echo esc_html( $cat->name ); ?>
								<span class="text-neutral-400">(<?php echo esc_html( $cat->count ); ?>)</span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		<?php endif; ?>

		<?php if ( ! is_wp_error( $tags ) && $tags ) : ?>
			<nav class="<?php echo esc_attr( $group ); ?>" aria-label="<?php esc_attr_e( 'Product tags', 'shop-groznet' ); ?>">
				<h2 class="<?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Tags', 'shop-groznet' ); ?></h2>
				<ul class="list-none m-0 p-0 flex flex-wrap gap-2">
					<?php foreach ( $tags as $tag ) : ?>
						<li>
							<a class="inline-block px-3 py-1 text-sm rounded-full border transition-colors <?php echo $current_tag === $tag->term_id ? 'bg-brand-600 border-brand-600 text-white' : 'border-neutral-200 dark:border-neutral-800 text-neutral-600 dark:text-neutral-400 hover:text-brand-600 dark:hover:text-brand-400 hover:border-brand-500'; ?>"
								href="<?php echo esc_url( add_query_arg( array_diff_key( wc_clean( wp_unslash( $_GET ) ), array( 'paged' => 1 ) ), get_term_link( $tag ) ) ); // phpcs:ignore WordPress.Security.NonceVerification ?>"
								<?php echo $current_tag === $tag->term_id ? 'aria-current="page"' : ''; ?>>
								<?php echo esc_html( $tag->name ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		<?php endif; ?>

		<?php if ( $price_hi > $price_lo ) : ?>
			<form class="<?php echo esc_attr( $group ); ?>" method="get" action="<?php echo esc_url( sgz_shop_url() ); ?>"
				x-data="{ lo: <?php echo (int) $min_set; ?>, hi: <?php echo (int) $max_set; ?>, min: <?php echo (int) $price_lo; ?>, max: <?php echo (int) $price_hi; ?> }">
				<h2 class="<?php sgz_ui_class( 'label' ); ?>"><?php esc_html_e( 'Price', 'shop-groznet' ); ?></h2>

				<div class="sgz-range relative h-6">
					<input type="range" :min="min" :max="max" step="1" x-model.number="lo" @input="lo = Math.min(lo, hi)"
						aria-label="<?php esc_attr_e( 'Minimum price', 'shop-groznet' ); ?>" />
					<input type="range" :min="min" :max="max" step="1" x-model.number="hi" @input="hi = Math.max(hi, lo)"
						aria-label="<?php esc_attr_e( 'Maximum price', 'shop-groznet' ); ?>" />
				</div>

				<p class="<?php sgz_ui_class( 'muted' ); ?> mt-1 mb-4">
					<?php echo esc_html( get_woocommerce_currency_symbol() ); ?><span x-text="lo"></span>
					&ndash;
					<?php echo esc_html( get_woocommerce_currency_symbol() ); ?><span x-text="hi"></span>
				</p>

				<input type="hidden" name="min_price" :value="lo" />
				<input type="hidden" name="max_price" :value="hi" />
				<?php wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged', 'product-page' ) ); ?>

				<div class="flex items-center gap-4">
					<button type="submit" class="<?php sgz_ui_class( 'btn_primary_sm' ); ?>"><?php esc_html_e( 'Apply', 'shop-groznet' ); ?></button>
					<?php if ( $filtering ) : ?>
						<a class="<?php echo esc_attr( $link ); ?>" href="<?php echo esc_url( sgz_shop_url( array( 'min_price' => false, 'max_price' => false ) ) ); ?>"><?php esc_html_e( 'Reset', 'shop-groznet' ); ?></a>
					<?php endif; ?>
				</div>
			</form>
		<?php endif; ?>

		<form class="<?php echo esc_attr( $group ); ?>" method="get" action="<?php echo esc_url( sgz_shop_url() ); ?>">
			<label class="flex items-center gap-3 text-sm text-neutral-600 dark:text-neutral-400 cursor-pointer">
				<input type="checkbox" class="sgz-checkbox" name="in_stock" value="1" <?php checked( ! empty( $_GET['in_stock'] ) ); // phpcs:ignore WordPress.Security.NonceVerification ?> @change="$el.form.submit()" />
				<?php esc_html_e( 'In stock only', 'shop-groznet' ); ?>
			</label>
			<?php wc_query_string_form_fields( null, array( 'in_stock', 'paged', 'product-page' ) ); ?>
			<noscript><button type="submit" class="<?php sgz_ui_class( 'btn_primary_sm', 'mt-3' ); ?>"><?php esc_html_e( 'Apply', 'shop-groznet' ); ?></button></noscript>
		</form>

	</div>
</aside>
