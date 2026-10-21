# Shop GrozNet

A classic (PHP-template) WooCommerce theme built to match the GrozNet static
site. Tailwind runs as the browser runtime with the static site's own
`tailwind.config` injected at runtime; Alpine.js is loaded deferred. No build
step.

- **Slug / text domain:** `shop-groznet`
- **Function prefix:** `sgz_` (constants `SGZ_*`)
- **Requires:** WordPress 6.0+, PHP 7.4+, WooCommerce (only needed for the shop)

---

## Read this first

Four things you should know before installing.

**1. The header and footer markup is not from your static site.** In the
`index.html` you sent, `<header id="header"></header>` and
`<footer id="footer">` are empty — they're populated at runtime by
`/assets/js/main.js`, which wasn't in the files provided. So this is the one
place I couldn't copy anything verbatim. `header.php` and `footer.php` are
built entirely from your site's own vocabulary (the container, the serif
wordmark, the `rounded-xl` icon buttons, the `neutral-50 / neutral-950` footer
band with its `text-[13px]` and `border-t`), but the structure is my
reconstruction. If you send `main.js` or the rendered HTML, swapping the real
markup in is a contained change to those two files.

**2. Cart and checkout overrides only apply to the shortcode pages.** Recent
WooCommerce installs create Cart and Checkout pages using the *Cart* and
*Checkout blocks*, which render from block markup and ignore
`wc_get_template()` entirely — the templates in `woocommerce/cart/` and
`woocommerce/checkout/` would simply never load. To use them, edit each page
and replace the block with the classic shortcode:

- Cart page → `[woocommerce_cart]`
- Checkout page → `[woocommerce_checkout]`

WooCommerce offers this directly: select the Cart or Checkout block and use
*Switch to classic shortcode* in the block toolbar. If you'd rather keep the
blocks, the last section of `assets/css/woocommerce.css` gives them
approximate theme styling using only the documented public
`.wc-block-components-*` class names.

**3. The templates carry no `@version` header, on purpose.** WooCommerce
compares that number against its own copy in **WooCommerce → Status →
Templates**, and I had no WooCommerce source to read the correct versions
from, so inventing numbers risked hiding a real update later. The consequence
is that every override is listed there as outdated. To silence it: open that
screen, read the "core version is X" it reports for each file, and add a
matching line to the file's docblock, e.g.

```php
 * @package Shop_GrozNet
 * @version 9.4.0
```

**4. Tailwind's browser runtime is a development tool.** It compiles CSS in
the visitor's browser on every page load. It's what your static site does
today, and it's what makes utility classes work with no build step — but on a
production store it costs a render-blocking script and a first-paint delay.
Two ways to improve it without changing any markup:

- Drop your existing `assets/js/tailwind.js` into `assets/vendor/tailwind.js`
  and the theme uses that instead of the CDN (same for
  `assets/vendor/alpine.min.js` and `assets/vendor/alpine-collapse.min.js`).
  `sgz_tailwind_src()` and `sgz_vendor_src()` do this check.
- Longer term, compile a static stylesheet from the same token array and
  enqueue that instead. Nothing in the templates would need to change.

---

## Installing

1. Copy the `shop-groznet` folder to `wp-content/themes/`, or upload the zip
   under **Appearance → Themes → Add New → Upload Theme**.
2. Activate it.
3. Under **Appearance → Menus**, assign menus to the *Primary menu* and
   *Footer menu* locations.
4. If WooCommerce is installed, do step 2 in "Read this first" for the cart
   and checkout pages.

---

## Where the design tokens live

There is one source of truth: **`sgz_design_tokens()` in `inc/enqueue.php`**.
It is a straight port of the `tailwind.config` object from your `index.html`:
`darkMode: 'class'`, the centred 1280px container with 16px padding, the
`serif` / `Arial, Helvetica, sans-serif` families, the eleven-step `brand`
ramp, the custom `scale-98` / `scale-103` values, and `preflight: true`.

Three things are generated from that one array, so they cannot drift apart:

| Output | Where | How |
| --- | --- | --- |
| `tailwind.config` for the runtime | inline after the Tailwind script | `wp_add_inline_script()` |
| `--sgz-brand-50` … `--sgz-brand-950` | inline after `theme.css` | `sgz_brand_custom_properties()` |
| Editor palette / fonts / sizes | `theme.json` | mirrors the same values |

Everything in the plain CSS files refers to `var(--sgz-brand-600)` rather than
a hex literal. `theme.json` is the one file holding a second copy of the ramp —
it has to be static JSON — so if you change a brand hex, change it in
`sgz_design_tokens()` and in `theme.json`.

Recurring **class combinations** live in `sgz_ui()` in
`inc/template-tags.php`: `card`, `panel`, `btn_primary`, `input`, `label`,
`notice`, `eyebrow`, `h1`…`h3`, `rule`, `price`, `badge`, and so on. Each
string was lifted from a real element on your static site — `panel` is the
contact form's surface, `card` is the portfolio card, `notice` is the amber
disclaimer box, `input` is the contact form control. Templates call
`sgz_ui_class( 'card' )` rather than repeating utility lists, so restyling
every product card is a one-line change. (`btn_icon`, `card_soft` and
`section_alt` are defined and available but not currently used by any
template.)

---

## File structure

```
shop-groznet/
├── style.css               Theme header, [x-cloak], .screen-reader-text
├── functions.php           Bootstrap: constants + require inc/*
├── theme.json              Editor palette, fonts, type scale, 1280px layout
├── screenshot.png          Placeholder — replace with a real capture
│
├── inc/
│   ├── setup.php           add_theme_support, menus, sidebars, textdomain
│   ├── enqueue.php         Tailwind + Alpine + CSS/JS, design tokens
│   ├── template-tags.php   sgz_ui() token map, sgz_icon(), nav filters
│   └── woocommerce.php     Wrappers, unhooks, fragments, form-field classes
│
├── header.php  footer.php  sidebar.php  searchform.php  comments.php
├── index.php  page.php  single.php  archive.php  search.php  404.php
│
├── template-parts/
│   ├── content.php  content-search.php  content-none.php
│   └── cart-drawer.php     Slide-over drawer; body is a cart fragment
│
├── assets/
│   ├── css/theme.css       Editor content, sub-menus, comments, pagination
│   ├── css/woocommerce.css Markup WooCommerce prints from PHP
│   ├── js/theme.js         Alpine store, dark mode, drawer focus handling
│   ├── js/woocommerce.js   added_to_cart / fragment events (jQuery)
│   └── vendor/             Optional self-hosted tailwind.js / alpine.min.js
│
├── languages/
│   ├── shop-groznet.pot    120 strings
│   ├── ru_RU.po            Full Russian translation
│   └── ru_RU.mo            Compiled
│
└── woocommerce/            Overrides — see the next section
```

---

## WooCommerce overrides

Overrides mirror the plugin's own `templates/` paths with `/templates/`
removed, which is what `wc_get_template()` resolves against. They are only
honoured because `inc/setup.php` calls
`add_theme_support( 'woocommerce' )` — without that declaration WooCommerce
falls back to shortcode-based "unsupported theme" rendering and ignores every
file below.

### There is deliberately no root `woocommerce.php`

A root-level `woocommerce.php` takes precedence over
`woocommerce/archive-product.php` and would silently disable the archive
override. Instead `inc/woocommerce.php` unhooks WooCommerce's own wrappers and
supplies its own:

```php
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'sgz_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'sgz_wrapper_end', 10 );
```

That's why pages this theme does *not* override — My Account, Order Received,
order tracking — still render inside the theme's header, container and footer.

### What is overridden, and why

**Product archive** (shop, categories, tags, and product search — WooCommerce
routes product searches through the same template)

| File | Why |
| --- | --- |
| `archive-product.php` | Page header with eyebrow, serif H1 and brand rule; toolbar row wrapping the result count and ordering |
| `content-product.php` | The card: image box, body, action pinned to the bottom |
| `loop/loop-start.php` `loop-end.php` | The grid lives on the `<ul>`; without this the cards sit in WooCommerce's float layout |
| `loop/add-to-cart.php` | Adds button classes while keeping `add_to_cart_button` / `ajax_add_to_cart` and the data attributes |
| `loop/price.php` `rating.php` `sale-flash.php` | Card typography and the badge |
| `loop/result-count.php` `orderby.php` `pagination.php` | Toolbar and pagination styling |
| `loop/no-products-found.php` | Empty state |

**Single product**

| File | Why |
| --- | --- |
| `single-product.php` | Wrapper; header/footer and hooks only |
| `content-single-product.php` | Two-column gallery/summary grid instead of the stacked default |
| `single-product/product-image.php` `product-thumbnails.php` | Rounded gallery surface and thumbnail strip |
| `single-product/title.php` is *not* overridden | The heading is swapped via a hook instead (`sgz_single_title`) |
| `single-product/price.php` `rating.php` `meta.php` | Summary typography |
| `single-product/sale-flash.php` | Badge |
| `single-product/tabs/tabs.php` | Tab styling from the portfolio filter pills |
| `single-product/related.php` | Reuses the archive card grid |
| `single-product/add-to-cart/simple.php` | Quantity + button row |
| `.../variable.php` | Variation selects, Clear link, `single_variation_wrap` |
| `.../variation.php` | The two JS templates that render the dynamic price, availability and description |
| `.../variation-add-to-cart-button.php` | The three hidden inputs the variation script writes into |
| `global/quantity-input.php` | Shared by the cart and both add-to-cart forms |

**Cart**

`cart/cart.php`, `cart-totals.php`, `cart-empty.php`,
`proceed-to-checkout-button.php`, `cross-sells.php`

**Checkout**

`checkout/form-checkout.php`, `form-billing.php`, `form-shipping.php`,
`form-coupon.php`, `form-login.php`, `review-order.php`, `payment.php`,
`payment-method.php`, `terms.php`, plus `global/form-login.php`

**Mini-cart**

`cart/mini-cart.php`, rendered into `template-parts/cart-drawer.php`

**Notices**

`notices/error.php`, `success.php`, `notice.php` — needed because
WooCommerce's own stylesheet is dequeued, so notices would otherwise be
unstyled on the cart and checkout.

### What was preserved exactly

Every `do_action()` and `apply_filters()` from the original template is
present, in order, with the `@hooked` comments kept so it's clear what runs
where. Also reproduced verbatim, because WooCommerce reads them directly:

- `cart[{key}][qty]` input names, `update_cart` and `apply_coupon` button
  names, and the `woocommerce-cart` nonce (`woocommerce-cart-nonce`)
- the `woocommerce-process_checkout` nonce
  (`woocommerce-process-checkout-nonce`), `#place_order` with
  `name="woocommerce_checkout_place_order"` and its `data-value`
- `#customer_details`, `#order_review`, `#order_review_heading`
- `#ship-to-different-address-checkbox` and the `.shipping_address` wrapper
- `#createaccount`, `#terms`, `payment_method_{id}`, `.payment_box`
- `.variations_form`, `data-product_variations`, `.reset_variations`,
  `.single_variation_wrap`, `tmpl-variation-template`
- `.remove_from_cart_button` with `data-cart_item_key`
- the `.woocommerce-product-gallery` wrapper, its `data-columns`, and the
  inline opacity transition the gallery script fades in

### Where a template renders something WooCommerce also hooks

Per your instruction, the default callback is **unhooked**, never the
`do_action()`. All of these live in `inc/woocommerce.php`:

| Unhooked | Rendered instead by |
| --- | --- |
| `woocommerce_template_loop_product_link_open` / `_close` | `content-product.php` (so image and body are separate boxes) |
| `woocommerce_template_loop_product_thumbnail` | `content-product.php` |
| `woocommerce_template_loop_product_title` | `content-product.php` |
| `woocommerce_template_single_title` | `sgz_single_title()` |
| `woocommerce_template_single_excerpt` | `sgz_single_excerpt()` |
| `woocommerce_widget_shopping_cart_button_view_cart` / `_proceed_to_checkout` | `cart/mini-cart.php` |
| `woocommerce_cross_sell_display` on `cart_collaterals` | re-hooked to `woocommerce_after_cart` so it runs full width |

Where WooCommerce generates markup from PHP with no template at all, classes
go on through filters rather than CSS: `woocommerce_form_field_args` (checkout
and account fields), `woocommerce_quantity_input_args`,
`woocommerce_order_button_html`, `woocommerce_breadcrumb_defaults`,
`nav_menu_link_attributes`.

---

## Cart fragments

`inc/woocommerce.php` registers two fragments on
`woocommerce_add_to_cart_fragments`:

- `span.sgz-cart-count` — the header badge
- `#sgz-cart-drawer-contents` — the whole mini-cart body

WooCommerce refreshes both over AJAX after every add-to-cart and removal, so
the drawer and the count update with no page reload. `wc-cart-fragments` is
force-enqueued in `inc/enqueue.php` because the header cart appears on every
page, not only WooCommerce ones. `assets/js/woocommerce.js` listens for
`added_to_cart` and opens the drawer.

---

## Accessibility

- Skip link to `#main`, visible on focus (`style.css`)
- `aria-expanded` on the search, mobile-menu and cart toggles, driven by
  Alpine so the value is always true
- Sub-menus open on `:hover` and `:focus-within`, so they are keyboard
  reachable; they carry `aria-haspopup` but deliberately **not**
  `aria-expanded`, which without JS would report a state that isn't real
- Cart drawer: `role="dialog"`, `aria-modal`, `aria-labelledby`, Escape to
  close, focus moved in on open and restored to the trigger on close, Tab
  trapped inside while open, body scroll locked
- A polite live region announces cart and theme changes (strings are
  translated, passed through `wp_localize_script`)
- `focus-visible` rings on every interactive element, offset for dark mode
- `prefers-reduced-motion` disables the transitions

---

## Responsive behaviour

Stock Tailwind breakpoints, as on the static site: `sm` 640, `md` 768, `lg`
1024. The container is centred at 1280px with 16px padding, and most sections
add `sm:px-12` — the same `container sm:px-12` pairing used throughout
`index.html`.

- Product grid: 1 → 2 (`md`) → 3 (`lg`)
- Single product: stacked → two columns at `lg`
- Cart: table on `md`+, stacked rows with inline labels below it
- Checkout: single column → 7/5 split at `lg`, summary sticky
- Header nav: full menu at `lg`, collapsible panel below

---

## Dark mode

`darkMode: 'class'`, matching your config. An inline script in `wp_head`
(priority 1) applies `.dark` to `<html>` before first paint so there's no
flash, reading `localStorage['sgz-color-scheme']` and falling back to
`prefers-color-scheme`.

If your existing `main.js` already persists a theme choice under a different
key, change `STORAGE_KEY` in `assets/js/theme.js` and the matching key in
`sgz_dark_mode_boot_script()` in `inc/enqueue.php` so the shop and the static
pages agree.

---

## Translation

Every user-facing string uses the `shop-groznet` domain, including strings
that came from WooCommerce core templates. That was your instruction and it
keeps the theme self-contained — but it does mean WooCommerce's own bundled
Russian translations no longer apply to those strings, so `languages/ru_RU.po`
ships a complete Russian translation of all 120 of them (correct three-form
plurals included). `ru_RU.mo` is compiled and ready.

To add a language: copy `shop-groznet.pot`, translate, and save as
`languages/{locale}.po` / `.mo` (e.g. `en_US.po`). `load_theme_textdomain()`
in `inc/setup.php` loads them from that folder.

---

## Not carried over from the static site

These are site-level rather than theme-level, and are easiest to add through a
child theme or a small plugin so they survive theme changes:

- Yandex Metrika (counter 95233076)
- The favicon, apple-touch-icon, `manifest.json` and the `noscript` redirect
- The `mailru-domain` verification meta tag
- The Font Awesome kit — this theme uses inline SVG (`sgz_icon()`) instead
- The homepage slider, portfolio, testimonials and services sections, which
  read from `/data/*.json`

One unrelated thing I noticed while reading `index.html`: in the slider's
Alpine component, `prev()` reads
`this.activeSlide = 1 ? this.slides.length : this.activeSlide - 1`. The
condition is the literal `1`, so it's always truthy and the left arrow always
jumps to the last slide. It was probably meant to be
`this.activeSlide === 1 ? ... : ...`. Not part of this theme, but worth fixing
on the static site.

---

## Validation

PHP has no interpreter in the environment this was built in, so `php -l`
wasn't available. Instead all 66 PHP files were checked with a lexer that
walks PHP/HTML mode, quotes, heredocs and comments, verifying: balanced
braces, parentheses and brackets; balanced alternative-syntax blocks
(`if`/`endif`, `foreach`/`endforeach`, …); a leading `<?php` with no BOM and
no trailing `?>`; and consistent text-domain use. Both JS files pass
`node --check`. `theme.json` parses as JSON, the CSS braces balance, and the
compiled `.mo` was verified by loading it through Python's `gettext` and
checking singular and all three plural forms resolve.

That is a structural check, not a runtime one. Before going live, run through
the store on a staging site: add a simple and a variable product to the cart,
update quantities, apply a coupon, and place a test order.
