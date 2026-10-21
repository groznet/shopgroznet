/**
 * WooCommerce front-end glue.
 *
 * WooCommerce communicates with the page over jQuery custom events, so this
 * file uses jQuery (declared as a dependency in inc/enqueue.php) even though
 * the rest of the theme's JS does not.
 *
 * What it does:
 *   - opens the cart drawer after a successful AJAX add-to-cart
 *   - keeps the header cart count's hidden state correct after fragments
 *     are replaced
 *   - announces cart changes to screen readers
 */
( function ( $ ) {
	'use strict';

	if ( ! $ ) {
		return;
	}

	var l10n = window.sgzL10n || {};

	/**
	 * Sync the count badge's visibility.
	 *
	 * The badge markup itself comes from a cart fragment, so this only has to
	 * cover the case where the fragment has not been re-rendered yet.
	 */
	function syncCartCount() {
		$( '.sgz-cart-count' ).each( function () {
			var $badge = $( this );
			var count = parseInt( $badge.text(), 10 );

			$badge.toggleClass( 'hidden', ! count );
		} );
	}

	// Fired by WooCommerce after an AJAX add-to-cart completes.
	$( document.body ).on( 'added_to_cart', function () {
		syncCartCount();

		if ( 'function' === typeof window.sgzOpenCart ) {
			window.sgzOpenCart();
		}
	} );

	// Fired after a mini-cart remove link is used.
	$( document.body ).on( 'removed_from_cart', function () {
		syncCartCount();

		if ( 'function' === typeof window.sgzAnnounce ) {
			window.sgzAnnounce( l10n.cartUpdated );
		}
	} );

	// Fired whenever WooCommerce swaps the registered fragments in.
	$( document.body ).on( 'wc_fragments_refreshed wc_fragments_loaded', syncCartCount );

	$( function () {
		syncCartCount();
	} );
}( window.jQuery ) );
