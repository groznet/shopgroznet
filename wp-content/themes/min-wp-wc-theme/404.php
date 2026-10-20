<?php
/**
 * The template for the 404 Not Found page.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary">
	<h1><?php esc_html_e( 'Page Not Found', 'min' ); ?></h1>
	<p><?php esc_html_e( 'The page you were looking for could not be found. It might have been removed, renamed, or it never existed.', 'min' ); ?></p>

	<?php get_search_form(); ?>

	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<p><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Visit the shop', 'min' ); ?></a></p>
	<?php endif; ?>
</main>
<?php
get_footer();
