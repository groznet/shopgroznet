# Architecture

## Design philosophy

This is a classic (non-block/non-FSE) PHP theme, chosen deliberately: a
`theme.json` + block-template approach pulls in an editor-driven layer of
wrapper divs and CSS custom properties that works against the "semantic
HTML does the structure, CSS is minimal" goal. Plain `header.php`/`page.php`/
etc. templates keep the markup fully under direct control.

CSS lives in exactly one file, `style.css`, with no preprocessor and no
framework. It exists only for what HTML/browser defaults cannot do:
fluid widths, image/table overflow, a handful of flex-wrap layouts
(nav, product grid, gallery), and enough vertical-rhythm rules to give the
top-level regions (`header`, `main`, `aside`, `footer`) spacing that the
browser doesn't provide for elements with no UA-default margin. Colors,
font sizes, link styling, and button appearance are left at browser
defaults — deliberately, since browser default buttons/links are already
"old web" in character.

## Template hierarchy

Standard WordPress hierarchy, no surprises:

- `header.php` / `footer.php` / `sidebar.php` — shared regions.
- `index.php` — fallback / blog index.
- `front-page.php` — static front page (falls back to `home.php`/`index.php`
  when no static front page is set).
- `home.php` — blog posts index when it is *not* the front page.
- `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`.
- `comments.php`, `searchform.php` — reusable partials invoked by the above.
- `template-parts/content.php` — shared post markup for loops and
  `single.php` (branches on `is_singular()` for heading level and full
  content vs. excerpt).
- `template-parts/content-none.php` — empty-result state.

### Heading structure

Exactly one `<h1>` per page is enforced by a simple rule split across two
places:

- `header.php` emits the site name as `<h1>` only when `is_front_page()`
  is true; everywhere else it's a `<p>`.
- Every content template supplies its own `<h1>` when it is *not* the
  front page: `single.php`/`content.php` (post title), `page.php` (page
  title), `archive.php` (`the_archive_title()`), `search.php` (query),
  `home.php` (`single_post_title()` when acting as a secondary blog page),
  WooCommerce's own core templates (shop/product title).

`front-page.php` intentionally emits no heading of its own — the site
name in the header *is* the page's `<h1>`.

## WooCommerce integration

- `add_theme_support( 'woocommerce' )` is declared in
  `inc/theme-setup.php`, but the gallery zoom/slider/lightbox feature
  flags are deliberately **not** added. Without them WooCommerce falls
  back to listing gallery images as plain stacked/wrapped `<img>` tags
  with no extra JS — consistent with "avoid JS that HTML doesn't need."
- `inc/woocommerce.php` disables WooCommerce's bundled stylesheets via
  `add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' )` so
  `style.css` is the only stylesheet on the site.
- `woocommerce.php` (theme root) is the required wrapper template. It
  intentionally does *not* remove WooCommerce's default
  `woocommerce_before_main_content` / `woocommerce_after_main_content`
  wrapper divs — that `<div class="woocommerce">` wrapper is kept because
  it's the scoping hook nearly all of WooCommerce's own template output
  and this theme's `.woocommerce …` CSS selectors rely on.
- `woocommerce/content-product.php` is the **only** WooCommerce template
  override. It is a minimal diff against WooCommerce core's own file: all
  the default `do_action()` hooks (sale flash, thumbnail, title, rating,
  price, add-to-cart) are left exactly as WooCommerce ships them, so
  third-party plugins that hook into the product loop keep working. The
  only change is wrapping the hooks in `<article>` instead of leaving the
  `<li>` as the sole element, since a product card is a real unit of
  content.
- Every other WooCommerce page (cart, checkout, My Account, single
  product, shop archive) uses WooCommerce's **unmodified** core
  templates. Their default markup (`<table>` for cart/orders, `<form>`
  for checkout fields, `<h1>` for page titles) was judged already
  semantic enough that overriding it would only add risk without a
  structural payoff — the explicit brief.

## CSS strategy details

- `body` gets a `max-width: 60rem` and centers via `margin: 0 auto`, wide
  enough for both prose and the product grid.
- `.entry-content` / `.page-content` / `.comment-content` narrow to
  `max-width: 42rem` for readable line length in long-form text; layout
  regions (nav, tables, product grid) are left at the full body width.
- Product grid and the WooCommerce gallery wrapper use
  `display: flex; flex-wrap: wrap` with a `flex-basis` per item — this is
  the one layout technique reused twice, and it removes the need for a
  media query to get column-count responsiveness (items just wrap).
- One `@media (max-width: 40rem)` query drops the product grid to a
  single column on small screens.
- `.woocommerce table.shop_table` is made horizontally scrollable
  (`display: block; overflow-x: auto`) rather than shrinking cart/order
  tables illegibly on narrow viewports — this was judged unavoidable per
  the brief's own "responsive tables … where unavoidable" allowance.

## JavaScript

None is authored by the theme. `wp_enqueue_script( 'comment-reply' )` is
conditionally enqueued (WordPress core script, only when threaded
comments are open on a singular post) and WooCommerce's own scripts load
as WooCommerce enqueues them — both left untouched.

## Known gaps / not verified

See docs/CHANGELOG.md "Known issues" for what has and hasn't been
exercised against a live WordPress + WooCommerce install.
