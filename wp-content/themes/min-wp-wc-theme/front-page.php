<?php
/**
 * The static front page template.
 *
 * The site title in header.php is the page's only <h1>; the page content
 * below starts at whatever heading level the editor used within it.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
	endif;

	if ( class_exists( 'WooCommerce' ) && function_exists( 'wc_get_featured_product_ids' ) && wc_get_featured_product_ids() ) :
		?>
		<section aria-label="<?php esc_attr_e( 'Featured products', 'min' ); ?>">
			<h2><?php esc_html_e( 'Featured Products', 'min' ); ?></h2>
			<?php echo do_shortcode( '[featured_products limit="4"]' ); ?>
		</section>
	<?php endif; ?>
</main>
<?php
get_sidebar();
get_footer();
