<?php
/**
 * The template for displaying search results.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary">
	<?php if ( have_posts() ) : ?>
		<header>
			<h1>
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Search Results for: %s', 'min' ),
					'<span>' . get_search_query() . '</span>'
				);
				?>
			</h1>
		</header>

		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content' );
		endwhile;

		the_posts_pagination();
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
</main>
<?php
get_sidebar();
get_footer();
