<?php
/**
 * The blog posts index, used when a static front page is set separately from it.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary">
	<?php if ( is_home() && ! is_front_page() ) : ?>
		<header>
			<h1><?php single_post_title(); ?></h1>
		</header>
	<?php endif; ?>

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
