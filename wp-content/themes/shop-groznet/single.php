<?php
/**
 * Single post template.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="primary" class="<?php sgz_ui_class( 'section' ); ?>">
	<div class="<?php sgz_ui_class( 'container' ); ?>">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-3xl mx-auto' ); ?>>

					<header class="mb-10 space-y-4">
						<span class="<?php sgz_ui_class( 'eyebrow' ); ?>">
							<?php
							$sgz_cats = get_the_category_list( ', ' );
							echo $sgz_cats ? wp_kses_post( $sgz_cats ) : esc_html__( 'Journal', 'shop-groznet' );
							?>
						</span>
						<h1 class="<?php sgz_ui_class( 'h1' ); ?>"><?php the_title(); ?></h1>
						<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>
						<?php sgz_entry_meta(); ?>
					</header>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="mb-10 overflow-hidden rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="sgz-prose <?php sgz_ui_class( 'body' ); ?>">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="mt-8 flex gap-2 text-sm font-bold">',
								'after'  => '</div>',
							)
						);
						?>
					</div>

					<footer class="mt-10 pt-8 border-t <?php sgz_ui_class( 'divider' ); ?>">
						<?php
						the_tags(
							'<div class="flex flex-wrap gap-2 text-xs font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400">',
							'',
							'</div>'
						);
						?>
					</footer>
				</article>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
				<?php
			endwhile;
			?>

		</main>
	</div>
</div>

<?php
get_footer();
