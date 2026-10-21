<?php
/**
 * Main template file. Required by WordPress and the final fallback in the
 * template hierarchy.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="primary" class="<?php sgz_ui_class( 'section' ); ?>">
	<div class="<?php sgz_ui_class( 'container' ); ?>">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header class="max-w-3xl mb-12 space-y-4">
						<span class="<?php sgz_ui_class( 'eyebrow' ); ?>"><?php esc_html_e( 'Journal', 'shop-groznet' ); ?></span>
						<h1 class="<?php sgz_ui_class( 'h1' ); ?>"><?php single_post_title(); ?></h1>
						<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>
					</header>
				<?php endif; ?>

				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
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
