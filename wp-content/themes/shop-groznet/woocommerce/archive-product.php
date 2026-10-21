<?php
/**
 * Product archive: shop page, product categories/tags, and product search
 * results (WooCommerce routes product searches here).
 *
 * Override of woocommerce/templates/archive-product.php.
 *
 * Every do_action() from the original is preserved. The page shell comes
 * from sgz_wrapper_start()/sgz_wrapper_end(), hooked onto
 * woocommerce_before_main_content / woocommerce_after_main_content in
 * inc/woocommerce.php -- there is deliberately no root woocommerce.php,
 * which would take precedence over this file.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/*
 * The breadcrumb and page title live in a full-width band above the content
 * shell, so the default breadcrumb callback (inside <main>) is unhooked for
 * this template; the hook itself stays for plugins.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
?>

<section id="shop-breadcrumb-section" class="py-6 md:py-8 bg-neutral-50 dark:bg-neutral-950 border-b border-neutral-200/50 dark:border-neutral-900 transition-colors duration-300">
	<div class="<?php sgz_ui_class( 'container' ); ?>">
		<div class="flex flex-col space-y-4">

			<?php woocommerce_breadcrumb( array( 'wrap_before' => sgz_breadcrumb_wrap_before() ) ); ?>

			<header class="woocommerce-products-header space-y-2">
				<h1 class="woocommerce-products-header__title page-title text-3xl md:text-4xl font-serif font-bold text-neutral-700 dark:text-white tracking-tight">
					<?php woocommerce_page_title(); ?>
				</h1>

				<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>

				<?php
				/**
				 * Hook: woocommerce_archive_description.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				ob_start();
				do_action( 'woocommerce_archive_description' );
				$sgz_description = trim( ob_get_clean() );

				// Skip the wrapper when empty: it would still add the space-y gap.
				if ( '' !== $sgz_description ) :
					?>
					<div class="sgz-archive-description max-w-3xl <?php sgz_ui_class( 'muted' ); ?>"><?php echo $sgz_description; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
				<?php endif; ?>

				<?php if ( is_search() ) : ?>
					<div class="max-w-xl pt-2"><?php get_search_form(); ?></div>
				<?php endif; ?>
			</header>

		</div>
	</div>
</section>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked sgz_wrapper_start - 10 (replaces woocommerce_output_content_wrapper)
 * @hooked woocommerce_breadcrumb - 20 (unhooked above: it is in the band)
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<?php
if ( woocommerce_product_loop() ) {

	// Filters sit left of the grid on lg+, behind a toggle below that.
	wc_set_loop_prop( 'sgz_filters', true );
	echo '<div class="lg:grid lg:grid-cols-[15rem_minmax(0,1fr)] lg:gap-10 lg:items-start">';
	get_template_part( 'template-parts/shop-filters' );
	echo '<div class="sgz-shop-results min-w-0">';

	/*
	 * The notices wrapper is stretched to full width by woocommerce.css so it
	 * sits above the result count / ordering row rather than inside it.
	 */
	echo '<div class="sgz-loop-toolbar flex flex-wrap items-center justify-between gap-4 mb-8">';

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	echo '</div>';

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );

	echo '</div></div>';
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked sgz_wrapper_end - 10 (replaces woocommerce_output_content_wrapper_end)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10 (unhooked when the widget area is empty)
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
