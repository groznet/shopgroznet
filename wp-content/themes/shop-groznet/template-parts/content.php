<?php
/**
 * Post card, using the same card treatment as the static site's portfolio grid.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( sgz_ui( 'card' ) ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block aspect-video w-full overflow-hidden bg-neutral-100 dark:bg-neutral-800" tabindex="-1" aria-hidden="true">
			<?php
			the_post_thumbnail(
				'medium_large',
				array(
					'class' => 'w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-103',
					'alt'   => '',
				)
			);
			?>
		</a>
	<?php endif; ?>

	<div class="p-6 flex flex-col grow">
		<span class="<?php sgz_ui_class( 'eyebrow' ); ?>"><?php echo esc_html( get_the_date() ); ?></span>

		<h2 class="<?php sgz_ui_class( 'h3' ); ?> mt-1 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors duration-200">
			<a href="<?php the_permalink(); ?>" class="focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 rounded"><?php the_title(); ?></a>
		</h2>

		<p class="<?php sgz_ui_class( 'muted' ); ?> mt-2 leading-relaxed"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>

		<div class="mt-auto pt-5">
			<a href="<?php the_permalink(); ?>" class="<?php sgz_ui_class( 'btn_ghost' ); ?> text-sm">
				<?php esc_html_e( 'Read more', 'shop-groznet' ); ?>
				<?php echo sgz_icon( 'arrow-right', 'w-4 h-4 transition-transform duration-200 group-hover:translate-x-1' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</a>
		</div>
	</div>
</article>
