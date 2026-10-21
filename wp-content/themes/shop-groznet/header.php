<?php
/**
 * Site header.
 *
 * Shared by every template, including all WooCommerce pages (WooCommerce
 * calls get_header( 'shop' ), which falls back to this file).
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'shop-groznet' ); ?></a>

<div id="page" class="site min-h-screen flex flex-col">

	<?php
	// Links point at the main GrozNet site; override with the sgz_main_site_url filter.
	$sgz_main = sgz_main_site_url();
	$sgz_btn  = 'sgz-header-action inline-flex items-center justify-center p-2 rounded-lg text-gray-600 dark:text-neutral-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500';
	$sgz_nav  = array(
		'/'         => 'Главная',
		'/services' => 'Услуги',
		'/catalog'  => 'Каталог',
		'/projects' => 'Наши Проекты',
		'/partners' => 'Партнеры',
		'http://blog.groznet.com/' => 'Блог и новости',
		'/about'    => 'О Компании',
		'/contact'  => 'Связаться',
	);
	?>
	<header id="header" class="site-header bg-white dark:bg-neutral-900 transition-colors duration-300"
		x-data="{ mobileOpen: false }"
		@keydown.escape.window="mobileOpen = false">

		<!-- Topbar -->
		<div class="border-b border-gray-200 dark:border-neutral-800 text-[14px] text-gray-500 dark:text-neutral-400 py-2">
			<div class="container flex flex-wrap justify-between">

				<div class="w-1/2 md:w-1/4">
					<p>Создание сайтов в Грозном</p>
				</div>

				<div class="w-1/2 md:w-1/4">
					<p class="text-right md:text-left">
						<a href="https://www.facebook.com/GrozNet/" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
						&nbsp;
						<a href="https://wa.me/+79298883327" aria-label="WhatsApp"><i class="fa fa-whatsapp"></i></a>
						&nbsp;
						<a href="https://t.me/groznetcom" aria-label="Telegram"><i class="fa fa-telegram"></i></a>
						&nbsp;
						<a href="https://vk.com/groznetcom" aria-label="VK"><i class="fa fa-vk"></i></a>
						&nbsp;
						<a href="https://instagram.com/groznet" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
						&nbsp;
						<a href="#" aria-label="YouTube"><i class="fa fa-youtube"></i></a>
					</p>
				</div>

				<div class="w-1/2 md:w-1/4">
					<p>
						<a href="#">Гарантия</a>
						<a href="<?php echo esc_url( $sgz_main . '/contact' ); ?>">Помощь</a>
						<a href="#">ЧАВО</a>
					</p>
				</div>

				<div class="w-1/2 md:w-1/4">
					<p class="text-right">
						<i class="fa fa-lock"></i>
						<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
							<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">Вход</a>
							<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">Регистрация</a>
						<?php else : ?>
							<a href="<?php echo esc_url( wp_login_url() ); ?>">Вход</a>
						<?php endif; ?>
					</p>
				</div>

			</div>
		</div>

		<!-- Midbar -->
		<div class="text-gray-700 dark:text-neutral-300">
			<div class="container flex flex-wrap justify-between">

				<!-- Logo -->
				<div id="logo" class="site-branding flex items-center w-1/3 lg:w-1/5 py-2 md:py-5">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php echo sgz_header_image( 'logo.svg', 'fa-globe', 'GrozNet', 'w-[2.8em] opacity-60', '2.8em' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</a>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:no-underline">
						<p class="-ml-[1.4em]">
							<span class="text-[28px] font-bold text-white [text-shadow:1px_1px_3px_rgb(100_115_125),0_0_3px_#92a6ae] font-serif">
								<span class="invisible">G</span>rozNet
							</span>
						</p>
					</a>
				</div>

				<!-- Worktime -->
				<div class="flex items-center justify-end md:justify-center gap-2 w-2/3 lg:w-1/5 py-2 md:py-5">
					<?php echo sgz_header_image( 'icons/worktime-48x48.png', 'fa-clock-o', 'График работы', 'opacity-60', '35' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>

					<p class="text-[15px]">
						<span class="text-gray-700 dark:text-neutral-300">Пон - Суб 9:00 - 18:00</span>
						<br>
						<span class="text-sm text-gray-500 dark:text-neutral-400">Служба поддержки 24/7</span>
					</p>
				</div>

				<!-- Address -->
				<div id="address" class="flex items-center justify-start md:justify-center gap-2 w-1/2 lg:w-1/5 py-2 md:py-5 bg-no-repeat"
					<?php echo sgz_header_bg( 'address-bg.png' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
					<?php echo sgz_header_image( 'icons/office-address-48x48.png', 'fa-map-marker', 'Адрес', 'opacity-60', '35' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>

					<p class="text-[15px]">
						<span class="text-gray-700 dark:text-neutral-300">пр-т Путина 8</span>
						<br>
						<span class="text-sm text-gray-500 dark:text-neutral-400">Грозный, Чечня</span>
					</p>
				</div>

				<!-- Contacts -->
				<div id="contacts" class="flex items-center justify-end md:justify-center gap-2 w-1/2 lg:w-1/5 py-0 md:py-5 bg-no-repeat"
					<?php echo sgz_header_bg( 'contacts-bg.png' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
					<?php echo sgz_header_image( 'icons/contact-us-icon-51x48.png', 'fa-phone', 'Контакты', 'opacity-60', '35' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>

					<p class="text-[15px]">
						<span class="text-gray-700 dark:text-neutral-300"><a href="tel:+79298883327">8 (929) 888-33-27</a></span>
						<br>
						<span class="text-sm text-gray-500 dark:text-neutral-400"><a href="mailto:info@groznet.com">info@groznet.com</a></span>
					</p>
				</div>

				<!-- Theme toggle, account and cart (from lg up; below that they sit in the navigation bar) -->
				<div class="hidden lg:flex items-center justify-end gap-2 w-1/5">
					<?php get_template_part( 'template-parts/header-actions' ); ?>
				</div>

			</div>
		</div>

		<!-- Navigation: links on the left; search, theme toggle, account and cart on the right -->
		<div class="border-y border-gray-200 dark:border-neutral-800 bg-white dark:bg-neutral-900">
			<div class="container flex flex-wrap items-center justify-between min-h-[46px]">

				<button type="button" class="<?php echo esc_attr( $sgz_btn ); ?> md:hidden"
					@click="mobileOpen = !mobileOpen"
					:aria-expanded="mobileOpen ? 'true' : 'false'"
					aria-controls="navbar"
					aria-label="<?php esc_attr_e( 'Toggle menu', 'shop-groznet' ); ?>">
					<i class="fa fa-bars text-lg"></i>
				</button>

				<nav id="navbar" class="main-navigation hidden md:block w-full md:w-auto order-last md:order-none"
					:class="mobileOpen ? 'block' : 'hidden md:block'"
					aria-label="<?php esc_attr_e( 'Primary menu', 'shop-groznet' ); ?>">
					<ul class="m-0 p-0 list-none">
						<?php foreach ( array_keys( $sgz_nav ) as $sgz_i => $path ) : $label = $sgz_nav[ $path ]; ?>
							<li class="md:inline-block border-t md:border-0 border-gray-200 dark:border-neutral-800">
								<a href="<?php echo esc_url( 0 === strpos( $path, 'http' ) ? $path : $sgz_main . $path ); ?>" class="block px-4 py-3 text-gray-600 dark:text-neutral-300 hover:text-brand-600 dark:hover:text-brand-400 no-underline text-sm font-medium<?php echo 0 === $sgz_i ? ' !pl-0' : ''; ?>"><?php echo esc_html( $label ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>

				<div class="flex items-center gap-2 py-1">

					<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 m-0">
						<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Введите название..."
							aria-label="<?php esc_attr_e( 'Search', 'shop-groznet' ); ?>"
							class="w-32 sm:w-48 text-gray-600 dark:text-neutral-300 text-sm px-3 py-1 bg-gray-50 dark:bg-neutral-950 border border-gray-300 dark:border-neutral-800 rounded focus:outline-none focus:ring-1 focus:ring-brand-500 focus:border-brand-500 placeholder-gray-400">
						<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
							<input type="hidden" name="post_type" value="product">
						<?php endif; ?>
						<input type="submit" value="Найти"
							class="hidden sm:block text-gray-600 dark:text-neutral-300 text-sm bg-white dark:bg-neutral-900 border border-gray-300 dark:border-neutral-800 rounded px-3 py-1 hover:bg-gray-50 dark:hover:bg-neutral-800 cursor-pointer transition-colors font-medium">
					</form>

					<div class="flex items-center gap-2 lg:hidden">
						<?php get_template_part( 'template-parts/header-actions' ); ?>
					</div>

				</div>
			</div>
		</div>
	</header>

	<div id="content" class="site-content flex-1">
