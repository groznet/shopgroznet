<?php
/**
 * The header for the theme: <head> and the opening <header> region.
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'min' ); ?></a>

<header>
	<?php if ( is_front_page() ) : ?>
		<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php else : ?>
		<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
	<?php endif; ?>

	<?php
	$min_description = get_bloginfo( 'description', 'display' );
	if ( $min_description || is_customize_preview() ) :
		?>
		<p><?php echo $min_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_bloginfo( 'description', 'display' ) is already escaped for display. ?></p>
	<?php endif; ?>

	<nav aria-label="<?php esc_attr_e( 'Primary menu', 'min' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id'        => false,
				'container'      => false,
				'fallback_cb'    => false,
			)
		);
		?>
	</nav>

	<?php if ( function_exists( 'WC' ) && WC()->cart ) : ?>
		<nav aria-label="<?php esc_attr_e( 'Cart', 'min' ); ?>">
			<ul>
				<li>
					<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
						<?php
						$min_cart_count = WC()->cart->get_cart_contents_count();
						printf(
							/* translators: %s: number of items in the cart */
							esc_html( _n( 'Cart (%s item)', 'Cart (%s items)', $min_cart_count, 'min' ) ),
							esc_html( $min_cart_count )
						);
						?>
					</a>
				</li>
				<?php if ( get_option( 'woocommerce_myaccount_page_id' ) ) : ?>
					<li><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'My Account', 'min' ); ?></a></li>
				<?php endif; ?>
			</ul>
		</nav>
	<?php endif; ?>
</header>
