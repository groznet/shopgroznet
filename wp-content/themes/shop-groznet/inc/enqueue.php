<?php
/**
 * Asset loading.
 *
 * There is no build step. Tailwind runs as the browser runtime and is
 * configured at runtime with the design tokens taken from the GrozNet
 * static site (assets/js/tailwind.js + the inline tailwind.config block
 * in index.html). Alpine is loaded deferred, exactly as on the static site.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/**
 * The design tokens.
 *
 * This is the single source of truth for the theme's Tailwind config and it
 * is a verbatim port of the tailwind.config object in the static site's
 * index.html. theme.json mirrors these same values for the block editor.
 *
 * @return array
 */
function sgz_design_tokens() {

	$tokens = array(
		// 'class' lets JS toggle dark mode rather than following the OS only.
		'darkMode' => 'class',
		'theme'    => array(
			'container' => array(
				'center'  => true,
				'padding' => '16px',
				'screens' => array(
					'DEFAULT' => '1280px',
				),
			),
			'extend'    => array(
				'fontFamily' => array(
					'serif' => array( 'serif' ),
					'sans'  => array( 'Arial', 'Helvetica', 'sans-serif' ),
				),
				'colors'     => array(
					// Single accent ramp. Change these and the whole theme follows.
					'brand' => array(
						'50'  => '#eff6ff',
						'100' => '#dbeafe',
						'200' => '#bfdbfe',
						'300' => '#93c5fd',
						'400' => '#60a5fa',
						'500' => '#3b82f6',
						'600' => '#2563eb',
						'700' => '#1d4ed8',
						'800' => '#1e40af',
						'900' => '#1e3a8a',
						'950' => '#172554',
					),
					// Canvas, surfaces, text and borders use stock `neutral`.
					// Notices use stock `amber`.
				),
				'scale'      => array(
					// Used by the active:scale-98 / group-hover:scale-103 transitions.
					'98'  => '.98',
					'103' => '1.03',
				),
			),
		),
		'corePlugins' => array(
			'preflight' => true,
		),
	);

	/**
	 * Filter the Tailwind runtime configuration.
	 *
	 * @param array $tokens Tailwind config as a PHP array.
	 */
	return apply_filters( 'sgz_design_tokens', $tokens );
}

/**
 * The brand ramp rendered as CSS custom properties.
 *
 * Emitted inline after assets/css/theme.css. Everything in the theme's plain
 * CSS refers to these variables instead of literal hex values, so the ramp is
 * defined in exactly one place: sgz_design_tokens().
 *
 * @return string
 */
function sgz_brand_custom_properties() {

	$tokens = sgz_design_tokens();
	$brand  = isset( $tokens['theme']['extend']['colors']['brand'] ) ? $tokens['theme']['extend']['colors']['brand'] : array();

	if ( empty( $brand ) ) {
		return '';
	}

	$lines = array();

	foreach ( $brand as $step => $hex ) {
		$lines[] = sprintf( '--sgz-brand-%s: %s;', sanitize_html_class( (string) $step ), esc_attr( $hex ) );
	}

	return ':root{' . implode( '', $lines ) . '}';
}

/**
 * Resolve the Tailwind runtime URL.
 *
 * A self-hosted copy at assets/vendor/tailwind.js wins if present (drop the
 * static site's /assets/js/tailwind.js in there to remove the CDN request
 * entirely); otherwise the pinned CDN build is used.
 *
 * @return string
 */
function sgz_tailwind_src() {
	if ( file_exists( get_theme_file_path( 'assets/vendor/tailwind.js' ) ) ) {
		return get_theme_file_uri( 'assets/vendor/tailwind.js' );
	}

	return SGZ_TAILWIND_CDN;
}

/**
 * Resolve an Alpine URL, preferring a self-hosted copy.
 *
 * @param string $file Filename inside assets/vendor/.
 * @param string $cdn  Fallback CDN URL.
 * @return string
 */
function sgz_vendor_src( $file, $cdn ) {
	if ( file_exists( get_theme_file_path( 'assets/vendor/' . $file ) ) ) {
		return get_theme_file_uri( 'assets/vendor/' . $file );
	}

	return $cdn;
}

/**
 * Enqueue front-end assets.
 *
 * @return void
 */
function sgz_enqueue_assets() {

	/*
	 * Tailwind browser runtime.
	 *
	 * Deliberately NOT deferred and NOT in the footer: the runtime compiles
	 * classes found in the DOM and then watches for mutations, so it has to
	 * be running before first paint or every page flashes unstyled. This
	 * mirrors the static site, which loads tailwind.js in <head>.
	 */
	wp_enqueue_script( 'sgz-tailwind', sgz_tailwind_src(), array(), null, false );

	// The runtime reads window.tailwind.config, so the config goes AFTER it.
	wp_add_inline_script(
		'sgz-tailwind',
		'tailwind.config = ' . wp_json_encode( sgz_design_tokens() ) . ';',
		'after'
	);

	// Alpine plugins must register before Alpine core boots.
	wp_enqueue_script(
		'sgz-alpine-collapse',
		sgz_vendor_src( 'alpine-collapse.min.js', SGZ_ALPINE_COLLAPSE_CDN ),
		array(),
		null,
		array(
			'in_footer' => false,
			'strategy'  => 'defer',
		)
	);

	wp_enqueue_script(
		'sgz-alpine',
		sgz_vendor_src( 'alpine.min.js', SGZ_ALPINE_CDN ),
		array( 'sgz-alpine-collapse' ),
		null,
		array(
			'in_footer' => false,
			'strategy'  => 'defer',
		)
	);

	// Font Awesome kit shared with the main GrozNet site (header icons).
	wp_enqueue_script( 'sgz-fontawesome', SGZ_FONTAWESOME_KIT, array(), null, array( 'strategy' => 'defer' ) );

	// Theme stylesheet (header + the handful of rules Tailwind cannot express).
	wp_enqueue_style( 'sgz-style', get_stylesheet_uri(), array(), SGZ_VERSION );
	wp_enqueue_style( 'sgz-theme', get_theme_file_uri( 'assets/css/theme.css' ), array( 'sgz-style' ), sgz_asset_version( 'assets/css/theme.css' ) );

	/*
	 * The brand ramp as CSS custom properties, generated from the same array
	 * that configures Tailwind. assets/css/theme.css and
	 * assets/css/woocommerce.css reference var(--sgz-brand-600) rather than
	 * repeating hex values, so the plain-CSS rules cannot drift away from the
	 * utility classes.
	 */
	wp_add_inline_style( 'sgz-theme', sgz_brand_custom_properties() );

	// Theme behaviour: dark mode toggle, drawer keyboard handling, menus.
	wp_enqueue_script( 'sgz-theme', get_theme_file_uri( 'assets/js/theme.js' ), array(), SGZ_VERSION, true );

	wp_localize_script(
		'sgz-theme',
		'sgzL10n',
		array(
			'menuOpened'  => __( 'Menu opened', 'shop-groznet' ),
			'menuClosed'  => __( 'Menu closed', 'shop-groznet' ),
			'cartOpened'  => __( 'Cart opened', 'shop-groznet' ),
			'cartClosed'  => __( 'Cart closed', 'shop-groznet' ),
			'cartUpdated' => __( 'Cart updated', 'shop-groznet' ),
			'darkOn'      => __( 'Dark theme enabled', 'shop-groznet' ),
			'darkOff'     => __( 'Light theme enabled', 'shop-groznet' ),
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( 'sgz-woocommerce', get_theme_file_uri( 'assets/css/woocommerce.css' ), array( 'sgz-theme' ), sgz_asset_version( 'assets/css/woocommerce.css' ) );

		wp_enqueue_script(
			'sgz-woocommerce',
			get_theme_file_uri( 'assets/js/woocommerce.js' ),
			array( 'jquery' ),
			SGZ_VERSION,
			true
		);

		/*
		 * Cart fragments power the mini-cart: WooCommerce refreshes the
		 * fragments registered in inc/woocommerce.php over AJAX after every
		 * add-to-cart, so the drawer and the header count update without a
		 * page reload. It is normally only enqueued where WooCommerce thinks
		 * it is needed; the header cart lives on every page, so force it.
		 */
		wp_enqueue_script( 'wc-cart-fragments' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sgz_enqueue_assets' );

/**
 * Replace WooCommerce's own stylesheets.
 *
 * The default woocommerce.css is built to be theme-agnostic with
 * percentage-based layout; it fights Tailwind's preflight and the GrozNet
 * card/panel styling. assets/css/woocommerce.css replaces it and styles the
 * markup WooCommerce prints itself (notices, price HTML, star ratings,
 * variation forms, My Account, tables) using the same tokens.
 *
 * @param array $styles Registered WooCommerce styles.
 * @return array
 */
function sgz_dequeue_woocommerce_styles( $styles ) {
	unset( $styles['woocommerce-general'] );
	unset( $styles['woocommerce-layout'] );
	unset( $styles['woocommerce-smallscreen'] );

	return $styles;
}
add_filter( 'woocommerce_enqueue_styles', 'sgz_dequeue_woocommerce_styles' );

/**
 * Set the dark class on <html> before first paint.
 *
 * darkMode is 'class', so the preference has to be applied before the
 * document renders or the page flashes light on every load. Printed inline
 * and early on purpose.
 *
 * @return void
 */
function sgz_dark_mode_boot_script() {
	$script = <<<'JS'
(function () {
	try {
		var stored = localStorage.getItem('sgz-color-scheme');
		var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
		if (stored === 'dark' || (stored === null && prefersDark)) {
			document.documentElement.classList.add('dark');
		}
	} catch (e) {}
})();
JS;

	if ( function_exists( 'wp_print_inline_script_tag' ) ) {
		wp_print_inline_script_tag( $script, array( 'id' => 'sgz-color-scheme-boot' ) );
	} else {
		echo '<script id="sgz-color-scheme-boot">' . $script . '</script>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'sgz_dark_mode_boot_script', 1 );

/**
 * Editor styles so the block editor roughly matches the front end.
 *
 * @return void
 */
function sgz_enqueue_editor_assets() {
	wp_enqueue_style( 'sgz-editor', get_theme_file_uri( 'assets/css/theme.css' ), array(), SGZ_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'sgz_enqueue_editor_assets' );

/**
 * The Font Awesome kit script must be loaded with crossorigin="anonymous".
 *
 * @param string $tag    Script tag.
 * @param string $handle Script handle.
 * @return string
 */
function sgz_fontawesome_kit_tag( $tag, $handle ) {
	if ( 'sgz-fontawesome' === $handle ) {
		$tag = str_replace( ' src=', ' crossorigin="anonymous" src=', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'sgz_fontawesome_kit_tag', 10, 2 );

/**
 * Cache-busting version for a theme asset: the file's modification time, so
 * a deploy changes the URL without bumping SGZ_VERSION by hand.
 *
 * @param string $path Path relative to the theme root.
 * @return string
 */
function sgz_asset_version( $path ) {
	$file = get_theme_file_path( $path );
	return file_exists( $file ) ? SGZ_VERSION . '.' . filemtime( $file ) : SGZ_VERSION;
}
