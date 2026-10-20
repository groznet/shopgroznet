<?php
/**
 * Small template-related helpers.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Replace the default "[&hellip;]" excerpt trail with a plain ellipsis;
 * content.php adds its own "Continue reading" link, so no second link is needed here.
 */
function min_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'min_excerpt_more' );
