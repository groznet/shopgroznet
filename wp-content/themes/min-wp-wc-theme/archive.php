<?php
/**
 * The template for displaying category, tag, author, and date archives.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary">
	<?php if ( have_posts() ) : ?>
		<header>
			<h1><?php the_archive_title(); ?></h1>
			<?php the_archive_description( '<div class="page-content">', '</div>' ); ?>
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
