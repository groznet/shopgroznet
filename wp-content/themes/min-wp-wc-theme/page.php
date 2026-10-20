<?php
/**
 * The template for displaying pages.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<h1><?php the_title(); ?></h1>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure><?php the_post_thumbnail( 'large' ); ?></figure>
			<?php endif; ?>

			<div class="page-content">
				<?php
				the_content();
				wp_link_pages(
					array(
						'before' => '<nav aria-label="' . esc_attr__( 'Page', 'min' ) . '"><p>' . esc_html__( 'Pages:', 'min' ),
						'after'  => '</p></nav>',
					)
				);
				?>
			</div>
		</article>

		<?php if ( comments_open() || get_comments_number() ) : ?>
			<?php comments_template(); ?>
		<?php endif; ?>
		<?php
	endwhile;
	?>
</main>
<?php
get_sidebar();
get_footer();
