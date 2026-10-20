<?php
/**
 * The footer for the theme.
 */

defined( 'ABSPATH' ) || exit;
?>
	<footer>
		<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
			<section aria-label="<?php esc_attr_e( 'Footer widgets', 'min' ); ?>">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</section>
		<?php endif; ?>

		<nav aria-label="<?php esc_attr_e( 'Footer menu', 'min' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_id'        => false,
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<p>
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</p>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
