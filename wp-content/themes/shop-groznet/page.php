<?php
/**
 * Single page template.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Cart, checkout and account pages get the shop's breadcrumb + title band.
$sgz_shop_band = function_exists( 'is_woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() );

if ( $sgz_shop_band ) :
	?>
<section id="shop-breadcrumb-section" class="py-6 md:py-8 bg-neutral-50 dark:bg-neutral-950 border-b border-neutral-200/50 dark:border-neutral-900 transition-colors duration-300">
	<div class="<?php sgz_ui_class( 'container' ); ?>">
		<div class="flex flex-col space-y-4">

			<?php woocommerce_breadcrumb( array( 'wrap_before' => sgz_breadcrumb_wrap_before() ) ); ?>

			<header class="space-y-2">
				<h1 class="page-title text-3xl md:text-4xl font-serif font-bold text-neutral-700 dark:text-white tracking-tight"><?php the_title(); ?></h1>
				<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>
			</header>

		</div>
	</div>
</section>
<?php endif; ?>

<div id="primary" class="<?php sgz_ui_class( 'section' ); ?>">
	<div class="<?php sgz_ui_class( 'container' ); ?>">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'mx-auto' ); ?>>

					<?php if ( ! $sgz_shop_band ) : ?>
						<header class="mb-10 space-y-4">
							<h1 class="<?php sgz_ui_class( 'h1' ); ?>"><?php the_title(); ?></h1>
							<div class="<?php sgz_ui_class( 'rule' ); ?>"></div>
						</header>
					<?php endif; ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="mb-10 overflow-hidden rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="sgz-prose <?php sgz_ui_class( 'body' ); ?>">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="mt-8 flex gap-2 text-sm font-bold">',
								'after'  => '</div>',
							)
						);
						?>
					</div>
				</article>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
				<?php
			endwhile;
			?>

		</main>
	</div>
</div>

<?php
get_footer();
