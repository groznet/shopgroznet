<?php
/**
 * Search results for non-product content.
 *
 * Product searches are handled by woocommerce/archive-product.php, which
 * WooCommerce loads for the product post type.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="primary" class="<?php sgz_ui_class( 'section' ); ?>">
	<div class="<?php sgz_ui_class( 'container' ); ?>">
		<main id="main" class="site-main" role="main">

			<header class="max-w-3xl mb-12 space-y-4">
				<span class="<?php sgz_ui_class( 'eyebrow' ); ?>"><?php esc_html_e( 'Search', 'shop-groznet' ); ?></span>
				<h1 class="<?php sgz_ui_class( 'h1' ); ?>">
					<?php
					printf(
						/* translators: %s: search query. */
						esc_html__( 'Results for %s', 'shop-groznet' ),
						'&ldquo;' . esc_html( get_search_query() ) . '&rdquo;'
					);
					?>
				</h1>
				<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>
				<div class="max-w-xl pt-2"><?php get_search_form(); ?></div>
			</header>

			<?php if ( have_posts() ) : ?>

				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'search' );
					endwhile;
					?>
				</div>

				<?php sgz_pagination(); ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

		</main>
	</div>
</div>

<?php
get_footer();
