<?php
/**
 * The template for displaying single posts.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary">
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content' );

		the_post_navigation(
			array(
				'prev_text' => '&larr; %title',
				'next_text' => '%title &rarr;',
			)
		);

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</main>
<?php
get_sidebar();
get_footer();
