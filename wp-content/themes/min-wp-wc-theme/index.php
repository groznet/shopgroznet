<?php
/**
 * The default template: blog index / fallback.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary">
	<?php if ( have_posts() ) : ?>
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
