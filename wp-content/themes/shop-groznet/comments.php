<?php
/**
 * Comments template. Required for classic themes; also used for product
 * reviews when WooCommerce is not handling them.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area max-w-3xl mx-auto mt-16 pt-10 border-t <?php sgz_ui_class( 'divider' ); ?>">

	<?php if ( have_comments() ) : ?>
		<h2 class="<?php sgz_ui_class( 'h3' ); ?> mb-8">
			<?php
			$sgz_comment_count = get_comments_number();
			printf(
				/* translators: %s: comment count. */
				esc_html( _n( '%s comment', '%s comments', $sgz_comment_count, 'shop-groznet' ) ),
				esc_html( number_format_i18n( $sgz_comment_count ) )
			);
			?>
		</h2>

		<ol class="comment-list space-y-6">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation(
			array(
				'prev_text' => esc_html__( 'Older comments', 'shop-groznet' ),
				'next_text' => esc_html__( 'Newer comments', 'shop-groznet' ),
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="<?php sgz_ui_class( 'notice' ); ?> mt-8"><?php esc_html_e( 'Comments are closed.', 'shop-groznet' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_form'           => 'comment-form space-y-5 mt-10',
			'class_submit'         => sgz_ui( 'btn_primary' ),
			'title_reply_before'   => '<h3 class="' . esc_attr( sgz_ui( 'h3' ) ) . ' mb-6">',
			'title_reply_after'    => '</h3>',
			'title_reply'          => esc_html__( 'Leave a comment', 'shop-groznet' ),
			'label_submit'         => esc_html__( 'Post comment', 'shop-groznet' ),
			'comment_field'        => sprintf(
				'<p class="comment-form-comment"><label class="%1$s" for="comment">%2$s</label><textarea id="comment" name="comment" class="%3$s" rows="5" required></textarea></p>',
				esc_attr( sgz_ui( 'label' ) ),
				esc_html__( 'Comment', 'shop-groznet' ),
				esc_attr( sgz_ui( 'textarea' ) )
			),
		)
	);
	?>
</div>
