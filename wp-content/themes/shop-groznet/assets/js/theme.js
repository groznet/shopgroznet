/**
 * Shop GrozNet theme behaviour.
 *
 * Loaded in the footer without defer, so it runs before Alpine (which is
 * deferred in the head). That ordering matters: the Alpine store below has to
 * be registered on alpine:init, which fires when the deferred bundle boots.
 *
 * Covers:
 *   - the Alpine store shared by the header cart button and the cart drawer
 *   - dark mode, persisted to localStorage under sgz-color-scheme
 *   - keyboard handling for the drawer (Escape, focus trap, focus restore)
 *   - a polite live region for screen reader announcements
 */
( function () {
	'use strict';

	var STORAGE_KEY = 'sgz-color-scheme';
	var l10n = window.sgzL10n || {};

	/* ---------------------------------------------------------------------
	 * Live region
	 * ------------------------------------------------------------------ */

	var liveRegion = null;

	function announce( message ) {
		if ( ! message ) {
			return;
		}

		if ( ! liveRegion ) {
			liveRegion = document.createElement( 'div' );
			liveRegion.setAttribute( 'aria-live', 'polite' );
			liveRegion.setAttribute( 'aria-atomic', 'true' );
			liveRegion.className = 'screen-reader-text';
			document.body.appendChild( liveRegion );
		}

		// Clearing first makes repeated identical messages announce again.
		liveRegion.textContent = '';
		window.setTimeout( function () {
			liveRegion.textContent = message;
		}, 50 );
	}

	/* ---------------------------------------------------------------------
	 * Dark mode
	 *
	 * The class is applied before first paint by the inline boot script in
	 * inc/enqueue.php; this only handles toggling and persistence.
	 * ------------------------------------------------------------------ */

	function isDark() {
		return document.documentElement.classList.contains( 'dark' );
	}

	function syncToggles() {
		var dark = isDark();

		document.querySelectorAll( '.sgz-color-scheme-toggle' ).forEach( function ( button ) {
			button.setAttribute( 'aria-pressed', dark ? 'true' : 'false' );
		} );
	}

	function toggleColorScheme() {
		var dark = ! isDark();

		document.documentElement.classList.toggle( 'dark', dark );

		try {
			window.localStorage.setItem( STORAGE_KEY, dark ? 'dark' : 'light' );
		} catch ( e ) {}

		syncToggles();
		announce( dark ? l10n.darkOn : l10n.darkOff );
	}

	document.addEventListener( 'click', function ( event ) {
		var toggle = event.target.closest( '.sgz-color-scheme-toggle' );

		if ( toggle ) {
			event.preventDefault();
			toggleColorScheme();
		}
	} );

	document.addEventListener( 'DOMContentLoaded', syncToggles );

	/* ---------------------------------------------------------------------
	 * Focus management for the cart drawer
	 * ------------------------------------------------------------------ */

	var FOCUSABLE = [
		'a[href]',
		'button:not([disabled])',
		'input:not([disabled]):not([type="hidden"])',
		'select:not([disabled])',
		'textarea:not([disabled])',
		'[tabindex]:not([tabindex="-1"])'
	].join( ',' );

	var lastFocused = null;

	function drawer() {
		return document.getElementById( 'sgz-cart-drawer' );
	}

	function focusableIn( container ) {
		if ( ! container ) {
			return [];
		}

		return Array.prototype.slice.call( container.querySelectorAll( FOCUSABLE ) ).filter( function ( element ) {
			return element.offsetParent !== null;
		} );
	}

	function onDrawerOpen() {
		lastFocused = document.activeElement;

		// Wait for Alpine's enter transition to make the panel focusable.
		window.setTimeout( function () {
			var items = focusableIn( drawer() );

			if ( items.length ) {
				items[ 0 ].focus();
			}
		}, 60 );

		document.body.style.overflow = 'hidden';
		announce( l10n.cartOpened );
	}

	function onDrawerClose() {
		document.body.style.overflow = '';

		if ( lastFocused && typeof lastFocused.focus === 'function' ) {
			lastFocused.focus();
		}

		lastFocused = null;
		announce( l10n.cartClosed );
	}

	// Trap Tab inside the drawer while it is open.
	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Tab' !== event.key ) {
			return;
		}

		var store = window.Alpine && window.Alpine.store ? window.Alpine.store( 'sgz' ) : null;

		if ( ! store || ! store.cartOpen ) {
			return;
		}

		var items = focusableIn( drawer() );

		if ( ! items.length ) {
			return;
		}

		var first = items[ 0 ];
		var last = items[ items.length - 1 ];

		if ( event.shiftKey && document.activeElement === first ) {
			event.preventDefault();
			last.focus();
		} else if ( ! event.shiftKey && document.activeElement === last ) {
			event.preventDefault();
			first.focus();
		}
	} );

	/* ---------------------------------------------------------------------
	 * Alpine store
	 * ------------------------------------------------------------------ */

	document.addEventListener( 'alpine:init', function () {
		window.Alpine.store( 'sgz', {
			cartOpen: false,

			openCart: function () {
				if ( this.cartOpen ) {
					return;
				}

				this.cartOpen = true;
				onDrawerOpen();
			},

			closeCart: function () {
				if ( ! this.cartOpen ) {
					return;
				}

				this.cartOpen = false;
				onDrawerClose();
			},

			toggleCart: function () {
				if ( this.cartOpen ) {
					this.closeCart();
				} else {
					this.openCart();
				}
			}
		} );
	} );

	/* ---------------------------------------------------------------------
	 * Public helper, used by assets/js/woocommerce.js
	 * ------------------------------------------------------------------ */

	window.sgzOpenCart = function () {
		var store = window.Alpine && window.Alpine.store ? window.Alpine.store( 'sgz' ) : null;

		if ( store ) {
			store.openCart();
		}
	};

	window.sgzAnnounce = announce;
}() );
