        <footer id="footer" class="bg-neutral-50 dark:bg-neutral-950 text-neutral-500 dark:text-neutral-400 text-[13px] pt-16 pb-8 border-t border-neutral-200/50 dark:border-neutral-900 transition-colors duration-300">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-12 gap-8 pb-12 border-b border-neutral-200/60 dark:border-neutral-900">

                    <!-- Links Container (Left Part) -->
                    <div class="xl:col-span-8 grid grid-cols-2 sm:grid-cols-4 gap-6">

                        <!-- Contacts -->
                        <div class="space-y-4">
                            <h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">
                                Контакты для связи
                            </h3>
                            <ul class="space-y-2.5 list-none p-0">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-phone w-4 text-neutral-400"></i>
                                    <a href="tel:+79298883327" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">8 (929) 888-33-27</a>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-envelope w-4 text-neutral-400"></i>
                                    <a href="mailto:info@groznet.com" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">info@groznet.com</a>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-brands fa-whatsapp w-4 text-neutral-400"></i>
                                    <a href="https://wa.me/+79298883327" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">WhatsApp</a>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-brands fa-telegram w-4 text-neutral-400"></i>
                                    <a href="https://t.me/groznetcom" class="hover:text-sky-500 dark:hover:text-sky-400 transition-colors">Telegram</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Services / Shop Links -->
                        <div class="space-y-4">
                            <h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">
                                Наш магазин
                            </h3>
                            <ul class="space-y-2.5 list-none p-0">
                                <li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Каталог товаров</a></li>
                                <li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Корзина</a></li>
                                <li><a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Оформление заказа</a></li>
                                <li><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Личный кабинет</a></li>
                            </ul>
                        </div>

                        <!-- Links -->
                        <div class="space-y-4">
                            <h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">
                                Полезные ссылки
                            </h3>
                            <ul class="space-y-2.5 list-none p-0">
                                <li><a href="https://groznet.com/" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Официальный сайт</a></li>
                                <li><a href="https://groznet.com/services" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Услуги веб-студии</a></li>
                                <li><a href="https://groznet.com/projects" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Портфолио проектов</a></li>
                                <li><a href="https://groznet.com/contact" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Обратная связь</a></li>
                            </ul>
                        </div>

                        <!-- User Account -->
                        <div class="space-y-4">
                            <h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">
                                Аккаунт
                            </h3>
                            <ul class="space-y-2.5 list-none p-0">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-user w-4 text-neutral-400"></i>
                                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Мой профиль</a>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-box-archive w-4 text-neutral-400"></i>
                                    <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Мои заказы</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <!-- Info Box (Right Part) -->
                    <div class="xl:col-span-4 space-y-4">
                        <h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">
                            GrozNet Digital Shop
                        </h3>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400 leading-relaxed">
                            Официальный интернет-магазин готовых веб-решений, шаблонов, плагинов и цифровых продуктов от IT-компании GrozNet.
                        </p>
                    </div>
                </div>

                <!-- Social Media & Copyright Bar -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 py-6 text-xs">
                    <p class="font-medium text-neutral-700 dark:text-neutral-300 whitespace-nowrap">
                        Следите за нами в соцсетях
                    </p>

                    <ul class="flex gap-5 p-0 list-none text-lg">
                        <li>
                            <a href="https://www.facebook.com/GrozNet/" title="Facebook" class="text-neutral-400 hover:text-blue-600 transition-colors">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://instagram.com/groznet" title="Instagram" class="text-neutral-400 hover:text-pink-600 transition-colors">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/+79298883327" title="WhatsApp" class="text-neutral-400 hover:text-emerald-600 transition-colors">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://t.me/groznetcom" title="Telegram" class="text-neutral-400 hover:text-sky-500 transition-colors">
                                <i class="fa-brands fa-telegram"></i>
                            </a>
                        </li>
                    </ul>

                    <p class="leading-relaxed text-neutral-500 dark:text-neutral-400">
                        GrozNet &copy; <?php echo date('Y'); ?> · Все права защищены.
                    </p>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>
