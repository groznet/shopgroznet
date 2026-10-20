<?php
/**
 * Template part shown when no posts match the query.
 */

defined( 'ABSPATH' ) || exit;
?>
<section>
	<h1><?php esc_html_e( 'Nothing found', 'min' ); ?></h1>

	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, no results matched your search. Try again with different terms.', 'min' ); ?></p>
	<?php else : ?>
		<p><?php esc_html_e( 'It looks like nothing was found here.', 'min' ); ?></p>
	<?php endif; ?>

	<?php get_search_form(); ?>
</section>
