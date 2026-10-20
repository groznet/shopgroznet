<?php
/**
 * Template part for displaying a single post's content in loops and on single.php.
 */

defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php if ( is_singular() ) : ?>
			<h1><?php the_title(); ?></h1>
		<?php else : ?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>

		<p>
			<?php
			printf(
				/* translators: %s: post date */
				esc_html__( 'Posted on %s', 'min' ),
				'<time datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>'
			);
			?>
			<?php if ( ! is_singular() ) : ?>
				&mdash; <?php the_author_posts_link(); ?>
			<?php endif; ?>
		</p>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure>
			<?php if ( is_singular() ) : ?>
				<?php the_post_thumbnail( 'large' ); ?>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
			<?php endif; ?>
		</figure>
	<?php endif; ?>

	<?php if ( is_singular() ) : ?>
		<div class="entry-content">
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<nav aria-label="' . esc_attr__( 'Page', 'min' ) . '"><p>' . esc_html__( 'Pages:', 'min' ),
					'after'  => '</p></nav>',
				)
			);
			?>
		</div>
		<footer>
			<?php
			$min_categories = get_the_category_list( ', ' );
			if ( $min_categories ) {
				printf( '<p>' . esc_html__( 'Categories: %s', 'min' ) . '</p>', $min_categories ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_the_category_list() output is already escaped by core.
			}
			$min_tags = get_the_tag_list( '', ', ' );
			if ( $min_tags && ! is_wp_error( $min_tags ) ) {
				printf( '<p>' . esc_html__( 'Tags: %s', 'min' ) . '</p>', $min_tags ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_the_tag_list() output is already escaped by core.
			}
			?>
		</footer>
	<?php else : ?>
		<div class="entry-content">
			<?php the_excerpt(); ?>
			<p><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue reading', 'min' ); ?> &rarr;</a></p>
		</div>
	<?php endif; ?>
</article>
