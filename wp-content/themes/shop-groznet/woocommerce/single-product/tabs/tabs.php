<?php
/**
 * Product data tabs.
 *
 * Override of woocommerce/templates/single-product/tabs/tabs.php.
 *
 * Rebuilt on the static site's filter-pill pattern (portfolio section) with
 * Alpine driving the panel switching. The woocommerce_product_tabs filter,
 * every tab callback, and the woocommerce_product_tab_panels_* hooks are all
 * preserved; only the wrapper markup and the tab controls changed.
 *
 * @package Shop_GrozNet
 */

defined( 'ABSPATH' ) || exit;

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) :

	$sgz_first_tab = key( $product_tabs );
	?>
	<div class="woocommerce-tabs wc-tabs-wrapper mt-16 pt-12 border-t <?php sgz_ui_class( 'divider' ); ?>"
		x-data="{ tab: '<?php echo esc_js( $sgz_first_tab ); ?>' }">

		<ul class="tabs wc-tabs <?php sgz_ui_class( 'tablist' ); ?> list-none m-0 mb-8 w-fit" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="presentation">
					<button type="button"
						class="<?php sgz_ui_class( 'tab' ); ?>"
						:class="tab === '<?php echo esc_js( $key ); ?>' ? '<?php echo esc_attr( sgz_ui( 'tab_active' ) ); ?>' : '<?php echo esc_attr( sgz_ui( 'tab_idle' ) ); ?>'"
						@click="tab = '<?php echo esc_js( $key ); ?>'"
						role="tab"
						:aria-selected="tab === '<?php echo esc_js( $key ); ?>' ? 'true' : 'false'"
						aria-controls="tab-<?php echo esc_attr( $key ); ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</button>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab sgz-prose <?php sgz_ui_class( 'body' ); ?>"
				id="tab-<?php echo esc_attr( $key ); ?>"
				role="tabpanel"
				aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>"
				x-show="tab === '<?php echo esc_js( $key ); ?>'"
				x-cloak>
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>
	<?php
endif;
