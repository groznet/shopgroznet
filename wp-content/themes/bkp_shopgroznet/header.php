<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/logo200x200.png">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class('bg-white dark:bg-neutral-950 text-neutral-800 dark:text-neutral-200 antialiased'); ?>>
        <?php wp_body_open(); ?>
        <header id="header">
            <!-- Topbar -->
            <div class="border-b border-gray-200 text-[14px] text-gray-500 py-2">
                <div class="container mx-auto flex flex-wrap justify-between px-4 sm:px-6 lg:px-8">

                    <div class="w-1/2 md:w-1/4">
                        <p>Создание сайтов в Грозном</p>
                    </div>

                    <div class="w-1/2 md:w-1/4">
                        <p class="text-right md:text-left">
                            <a href="https://www.facebook.com/GrozNet/"><i class="fa-brands fa-facebook"></i></a>
                            &nbsp;
                            <a href="https://wa.me/+79298883327"><i class="fa fa-whatsapp"></i></a>
                            &nbsp;
                            <a href="https://t.me/groznetcom"><i class="fa fa-telegram"></i></a>
                            &nbsp;
                            <a href="https://vk.com/groznetcom"><i class="fa fa-vk"></i></a>
                            &nbsp;
                            <a href="https://instagram.com/groznet"><i class="fa fa-instagram"></i></a>
                            &nbsp;
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </p>
                    </div>

                    <div class="w-1/2 md:w-1/4">
                        <p>
                            <a href="#">Гарантия</a>
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Помощь</a>
                            <a href="#">ЧАВО</a>
                        </p>
                    </div>

                    <div class="w-1/2 md:w-1/4">
                        <p class="text-right">
                            <i class="fa fa-lock"></i>
                            <?php if ( is_user_logged_in() ) : ?>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">Мой кабинет</a>
                            <?php else : ?>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">Вход</a>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">Регистрация</a>
                            <?php endif; ?>
                        </p>
                    </div>

                </div>
            </div>

            <!-- Midbar -->
            <div class="text-gray-700">
                <div class="container mx-auto flex flex-wrap justify-between items-center px-4 sm:px-6 lg:px-8 py-3">

                    <!-- Logo -->
                    <div id="logo" class="flex items-center w-1/3 lg:w-1/5 py-2">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 hover:no-underline">
                            <span class="text-[28px] font-bold text-neutral-900 dark:text-white font-serif">
                                GrozNet <span class="text-xs font-sans text-blue-600 font-semibold uppercase tracking-wider ml-1">Shop</span>
                            </span>
                        </a>
                    </div>

                    <!-- Worktime -->
                    <div class="hidden sm:flex items-center justify-end md:justify-center gap-2 w-2/3 lg:w-1/5 py-2">
                        <p class="text-[15px]">
                            <span class="text-gray-700 dark:text-neutral-300 font-medium">
                                Пон - Суб 9:00 - 18:00
                            </span>
                            <br>
                            <span class="text-sm text-gray-500 dark:text-neutral-400">
                                Служба поддержки 24/7
                            </span>
                        </p>
                    </div>

                    <!-- Address -->
                    <div id="address" class="hidden lg:flex items-center justify-center gap-2 w-1/5 py-2">
                        <p class="text-[15px]">
                            <span class="text-gray-700 dark:text-neutral-300 font-medium">
                                пр-т Путина 8
                            </span>
                            <br>
                            <span class="text-sm text-gray-500 dark:text-neutral-400">
                                Грозный, Чечня
                            </span>
                        </p>
                    </div>

                    <!-- Contacts -->
                    <div id="contacts" class="flex items-center justify-end md:justify-center gap-2 w-1/2 lg:w-1/5 py-2">
                        <p class="text-[15px] text-right md:text-left">
                            <span class="text-gray-700 dark:text-neutral-300 font-semibold">
                                <a href="tel:+79298883327" class="hover:text-blue-600">
                                    8 (929) 888-33-27
                                </a>
                            </span>
                            <br>
                            <span class="text-sm text-gray-500 dark:text-neutral-400">
                                <a href="mailto:info@groznet.com" class="hover:text-blue-600">
                                    info@groznet.com
                                </a>
                            </span>
                        </p>
                    </div>

                    <!-- Cart / Account Quick Access -->
                    <div class="flex items-center justify-end gap-3 w-auto lg:w-1/5">
                        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="relative flex items-center gap-2 px-3.5 py-2 rounded-xl bg-blue-50 dark:bg-neutral-800 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white transition-all font-semibold text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>
                                <span>Корзина</span>
                                <?php $cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
                                <?php if ( $cart_count > 0 ) : ?>
                                    <span class="ml-1 px-2 py-0.5 text-xs font-bold bg-blue-600 text-white rounded-full"><?php echo esc_html( $cart_count ); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <!-- Navigation -->
            <div class="border-y border-gray-200 bg-white dark:bg-neutral-900">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between min-h-[46px]">
                    <nav id="navbar" class="block py-2 md:py-0">
                        <ul class="m-0 p-0 list-none flex flex-wrap items-center gap-1 md:gap-4 text-sm font-medium">
                            <li>
                                <a href="https://groznet.com/" class="block px-3 py-2 text-neutral-600 dark:text-neutral-300 hover:text-blue-600 transition-colors">
                                    Главная
                                </a>
                            </li>
                            <li>
                                <a href="https://groznet.com/services" class="block px-3 py-2 text-neutral-600 dark:text-neutral-300 hover:text-blue-600 transition-colors">
                                    Услуги
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="block px-3 py-2 text-blue-600 dark:text-blue-400 font-bold border-b-2 border-blue-600">
                                    Магазин
                                </a>
                            </li>
                            <li>
                                <a href="https://groznet.com/projects" class="block px-3 py-2 text-neutral-600 dark:text-neutral-300 hover:text-blue-600 transition-colors">
                                    Проекты
                                </a>
                            </li>
                            <li>
                                <a href="https://groznet.com/about" class="block px-3 py-2 text-neutral-600 dark:text-neutral-300 hover:text-blue-600 transition-colors">
                                    О Компании
                                </a>
                            </li>
                            <li>
                                <a href="https://groznet.com/contact" class="block px-3 py-2 text-neutral-600 dark:text-neutral-300 hover:text-blue-600 transition-colors">
                                    Контакты
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <form id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="py-2 md:py-0 flex items-center space-x-2">
                        <input
                            type="text"
                            name="s"
                            placeholder="Поиск товаров..."
                            value="<?php echo get_search_query(); ?>"
                            class="text-neutral-700 dark:text-neutral-200 text-sm px-3 py-1.5 bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all placeholder-neutral-400"
                        >
                        <input type="hidden" name="post_type" value="product" />
                        <button
                            type="submit"
                            class="text-sm bg-blue-600 text-white rounded-lg px-3 py-1.5 hover:bg-blue-700 cursor-pointer transition-colors font-medium"
                        >
                            Найти
                        </button>
                    </form>
                </div>
            </div>
        </header>
