<?php
/**
 * The theme's WooCommerce wrapper template.
 *
 * Required by WooCommerce for full theme integration: it is used for the
 * shop, product archives/taxonomies, single products, cart, checkout and
 * My Account whenever WooCommerce doesn't have a more specific template
 * (e.g. this theme's product loop override) to fall back on.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary">
	<?php woocommerce_content(); ?>
</main>
<?php
get_sidebar();
get_footer();
