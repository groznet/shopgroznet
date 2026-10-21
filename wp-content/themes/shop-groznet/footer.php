<?php
/**
 * Site footer.
 *
 * Shared by every template, including all WooCommerce pages.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
	</div><!-- #content -->

	<footer id="colophon"
		class="site-footer bg-neutral-50 dark:bg-neutral-950 text-neutral-500 dark:text-neutral-400 text-[13px] pt-16 pb-8 border-t border-neutral-200/50 dark:border-neutral-900 transition-colors duration-300">

		<div class="<?php sgz_ui_class( 'container' ); ?>">

			<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-12 gap-8 pb-12 border-b border-neutral-200/60 dark:border-neutral-900">

				<div class="xl:col-span-8 grid grid-cols-2 sm:grid-cols-4 gap-6">
				<div class="space-y-4">
					<h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">Контакты для связи</h3>
					<ul class="space-y-2.5 list-none p-0">
						<li class="flex items-center gap-2">
							<i class="fa-solid fa-phone w-4 text-neutral-400" aria-hidden="true"></i>
							<a href="tel:+79298883327" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">8 (929) 888-33-27</a>
						</li>
						<li class="flex items-center gap-2">
							<i class="fa-solid fa-envelope w-4 text-neutral-400" aria-hidden="true"></i>
							<a href="mailto:info@groznet.com" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">info@groznet.com</a>
						</li>
						<li class="flex items-center gap-2">
							<i class="fa-brands fa-whatsapp w-4 text-neutral-400" aria-hidden="true"></i>
							<a href="https://wa.me/+79298883327" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">WhatsApp</a>
						</li>
						<li class="flex items-center gap-2">
							<i class="fa-brands fa-telegram w-4 text-neutral-400" aria-hidden="true"></i>
							<a href="https://t.me/groznetcom" class="hover:text-sky-500 dark:hover:text-sky-400 transition-colors">Telegram</a>
						</li>
						<li class="flex items-center gap-2">
							<i class="fa-solid fa-headset w-4 text-neutral-400" aria-hidden="true"></i>
							<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Поддержка</a>
						</li>
					</ul>
				</div>

				<div class="space-y-4">
					<h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">Наши услуги</h3>
					<ul class="space-y-2.5 list-none p-0">
						<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Разработка сайта</a></li>
						<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Поддержка сайтов</a></li>
						<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Создание приложения</a></li>
						<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">SEO Продвижение</a></li>
						<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Дизайн и брендинг</a></li>
					</ul>
				</div>

				<div class="space-y-4">
					<h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">Полезные ссылки</h3>
					<ul class="space-y-2.5 list-none p-0">
						<li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Карта сайта</a></li>
						<li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Условия использования</a></li>
						<li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Гарантия и сроки</a></li>
						<li><a href="#testimony-section" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Отзывы клиентов</a></li>
						<li><a href="<?php echo esc_url( home_url( '/projects' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Наши Проекты</a></li>
					</ul>
				</div>

				<div class="space-y-4">
					<h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">Личный кабинет</h3>
					<ul class="space-y-2.5 list-none p-0">
						<li class="flex items-center gap-2">
							<i class="fa-solid fa-arrow-right-to-bracket w-4 text-neutral-400" aria-hidden="true"></i>
							<a href="<?php echo esc_url( home_url( '/login' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Вход для клиентов</a>
						</li>
						<li class="flex items-center gap-2">
							<i class="fa-solid fa-user w-4 text-neutral-400" aria-hidden="true"></i>
							<a href="<?php echo esc_url( home_url( '/register' ) ); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Регистрация</a>
						</li>
						<li class="flex items-center gap-2">
							<i class="fa-solid fa-lock w-4 text-neutral-400" aria-hidden="true"></i>
							<a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Мой профиль</a>
						</li>
					</ul>
				</div>

				</div>

				<!-- Newsletter (disabled) -->
				<div class="xl:col-span-4 space-y-4">
					<h3 class="font-semibold text-neutral-800 dark:text-neutral-200 text-sm tracking-wide">Подписка на новости</h3>

					<form class="space-y-3 max-w-sm pointer-events-none opacity-60">
						<label for="ftrEmailInput" class="block text-neutral-500 dark:text-neutral-400 text-xs">Введите адрес электронной почты</label>
						<div class="flex gap-2">
							<input type="email" id="ftrEmailInput" placeholder="example@groznet.com" disabled class="w-full px-3 py-2.5 rounded-sm border border-neutral-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-white placeholder-neutral-400">
							<button type="button" disabled aria-label="Подписаться" class="px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-sm">
								<i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
							</button>
						</div>
					</form>

					<p class="text-xs text-neutral-500 dark:text-neutral-400 leading-relaxed">
						В настоящее время форма подписки отключена. Сайт не осуществляет сбор,
						хранение и обработку персональных данных через данную форму в соответствии
						с требованиями Федерального закона №152-ФЗ.
					</p>
				</div>
			</div>

			<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 py-6 border-b border-neutral-200/60 dark:border-neutral-900 text-xs">

				<p class="font-medium text-neutral-700 dark:text-neutral-300 whitespace-nowrap">Следите за нами в соцсетях</p>

				<ul class="flex gap-5 p-0 list-none text-lg">
					<li>
						<a href="https://www.facebook.com/GrozNet/" title="Facebook" aria-label="Facebook" class="text-neutral-400 hover:text-blue-600 transition-colors">
							<i class="fa-brands fa-facebook" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="#" title="YouTube" aria-label="YouTube" class="text-neutral-400 hover:text-red-600 transition-colors">
							<i class="fa-brands fa-youtube" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="https://instagram.com/groznet" title="Instagram" aria-label="Instagram" class="text-neutral-400 hover:text-pink-600 transition-colors">
							<i class="fa-brands fa-instagram" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="https://wa.me/+79298883327" title="WhatsApp" aria-label="WhatsApp" class="text-neutral-400 hover:text-emerald-600 transition-colors">
							<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="https://t.me/groznetcom" title="Telegram" aria-label="Telegram" class="text-neutral-400 hover:text-sky-500 transition-colors">
							<i class="fa-brands fa-telegram" aria-hidden="true"></i>
						</a>
					</li>
				</ul>

				<p class="leading-relaxed text-neutral-500 dark:text-neutral-400">
					GrozNet &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> · Все права защищены.
					<a href="#" rel="nofollow" class="underline hover:text-blue-600 dark:hover:text-blue-400 ml-1">Политика конфиденциальности</a>
					<span class="mx-1">·</span>
					<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="underline hover:text-blue-600 dark:hover:text-blue-400">По сотрудничеству</a>
				</p>
			</div>

		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
