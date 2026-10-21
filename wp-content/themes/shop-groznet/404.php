<?php
/**
 * 404 template.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="primary" class="<?php sgz_ui_class( 'section' ); ?>">
	<div class="<?php sgz_ui_class( 'container' ); ?>">
		<main id="main" class="site-main" role="main">

			<div class="max-w-2xl mx-auto text-center space-y-6 py-8">
				<span class="<?php sgz_ui_class( 'eyebrow' ); ?>"><?php esc_html_e( 'Error 404', 'shop-groznet' ); ?></span>
				<h1 class="<?php sgz_ui_class( 'h1' ); ?>"><?php esc_html_e( 'Page not found', 'shop-groznet' ); ?></h1>
				<div class="<?php sgz_ui_class( 'rule' ); ?> mx-auto"></div>
				<p class="<?php sgz_ui_class( 'body' ); ?>">
					<?php esc_html_e( 'The page you were looking for has moved or never existed. Try a search instead.', 'shop-groznet' ); ?>
				</p>
				<div class="max-w-md mx-auto pt-2"><?php get_search_form(); ?></div>
				<div class="pt-4">
					<a class="<?php sgz_ui_class( 'btn_primary' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php esc_html_e( 'Back to home', 'shop-groznet' ); ?>
					</a>
				</div>
			</div>

		</main>
	</div>
</div>

<?php
get_footer();
