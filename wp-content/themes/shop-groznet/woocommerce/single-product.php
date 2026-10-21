<?php
/**
 * Single product page.
 *
 * Override of woocommerce/templates/single-product.php.
 *
 * Structurally identical to the original -- it is a wrapper -- but it emits
 * the theme's header/footer and page shell. The real layout work happens in
 * content-single-product.php, which is why both are overridden together.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/*
 * Same full-width band as the archive: breadcrumb and product title sit above
 * the content shell, so the in-<main> breadcrumb is unhooked here (the hook
 * stays for plugins). The band heading is generic (the shop's name); the
 * product name stays the page's single <h1> in the summary.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

$sgz_shop_title = get_the_title( wc_get_page_id( 'shop' ) );
if ( '' === $sgz_shop_title ) {
	$sgz_shop_title = __( 'Shop', 'shop-groznet' );
}
?>

<section id="shop-breadcrumb-section" class="py-6 md:py-8 bg-neutral-50 dark:bg-neutral-950 border-b border-neutral-200/50 dark:border-neutral-900 transition-colors duration-300">
	<div class="<?php sgz_ui_class( 'container' ); ?>">
		<div class="flex flex-col space-y-4">

			<?php woocommerce_breadcrumb( array( 'wrap_before' => sgz_breadcrumb_wrap_before() ) ); ?>

			<header class="woocommerce-products-header space-y-2">
				<p class="woocommerce-products-header__title page-title text-3xl md:text-4xl font-serif font-bold text-neutral-700 dark:text-white tracking-tight">
					<?php echo esc_html( $sgz_shop_title ); ?>
				</p>

				<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>
			</header>

		</div>
	</div>
</section>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked sgz_wrapper_start - 10 (replaces woocommerce_output_content_wrapper)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

while ( have_posts() ) {
	the_post();

	wc_get_template_part( 'content', 'single-product' );
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
