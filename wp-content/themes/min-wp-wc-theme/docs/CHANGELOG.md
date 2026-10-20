# Changelog

## 2026-09-04 — Initial theme build

**Task:** Build a complete HTML-first, minimal-CSS WordPress + WooCommerce
theme from an empty repository, per the design brief in the originating
task description.

**Files affected:** all files in the repository (initial creation) —
`style.css`, `functions.php`, `inc/theme-setup.php`,
`inc/template-functions.php`, `inc/woocommerce.php`, `header.php`,
`footer.php`, `sidebar.php`, `index.php`, `home.php`, `front-page.php`,
`page.php`, `single.php`, `archive.php`, `search.php`, `404.php`,
`comments.php`, `searchform.php`, `template-parts/content.php`,
`template-parts/content-none.php`, `woocommerce.php`,
`woocommerce/content-product.php`, `readme.txt`, `LICENSE`, `.gitignore`,
`docs/ARCHITECTURE.md`, `docs/CHANGELOG.md`.

**What was implemented:**

- A full classic WordPress template hierarchy (see `docs/ARCHITECTURE.md`
  for the complete list) built around semantic elements (`header`, `nav`,
  `main`, `article`, `aside`, `footer`, headings, lists) with as few
  wrapper `<div>`s as the underlying WordPress/WooCommerce functions
  allow.
- A single ~180-line `style.css` covering: box-sizing reset, fluid body
  width, prose line-length limiting, vertical rhythm between top-level
  regions, screen-reader/skip-link/focus-visible accessibility rules,
  flex-wrap navigation, table overflow handling, form field sizing, and a
  flex-wrap WooCommerce product grid/gallery with one small-screen media
  query. No color palette, shadows, gradients, rounded cards, or
  animations were added — link/button/table/form appearance is left at
  browser defaults.
- WooCommerce support: `add_theme_support( 'woocommerce' )` without
  gallery zoom/slider/lightbox flags, WooCommerce's bundled stylesheets
  disabled in favor of the theme's own CSS, the required `woocommerce.php`
  wrapper template, and a single template override
  (`woocommerce/content-product.php`) that adds an `<article>` wrapper
  around WooCommerce's existing loop-item hooks without changing their
  behavior. Cart, checkout, My Account, single product, and shop/archive
  pages all use WooCommerce's unmodified core templates.
- `docs/ARCHITECTURE.md` documenting the actual structure and the
  reasoning behind each notable decision (heading strategy, why only one
  WooCommerce template is overridden, why gallery JS features are
  omitted, etc.).

**Important technical decisions:**

- Chose a classic PHP theme over a block/FSE theme so template markup
  stays fully hand-authored rather than passing through the block
  editor's own wrapper/CSS-variable layer.
- `is_front_page()` alone (not `is_front_page() && is_home()`) decides
  whether the site name in `header.php` renders as `<h1>` vs. `<p>`, so
  that both "front page = blog index" and "static front page" setups end
  up with exactly one `<h1>` per page (see `docs/ARCHITECTURE.md` for the
  full walk-through).
- WooCommerce's default `<div class="woocommerce">` wrapper (from
  `woocommerce_before_main_content` / `_after_main_content`) was
  deliberately kept rather than stripped — it's the scoping class this
  theme's own `.woocommerce …` CSS and most of WooCommerce's internal
  markup depend on.

**Testing performed:**

- `php -l` (PHP 8.4.19) against every `.php` file in the theme — all 15
  files pass with no syntax errors.
- Manual review of the WordPress template hierarchy and of the
  WooCommerce hook usage in `woocommerce/content-product.php` against
  WooCommerce core's own `templates/content-product.php`, to confirm the
  override is a genuine minimal diff (same hooks, same order, only the
  `<article>` wrapper added) rather than a behavioral change.

**Known issues / not yet verified:**

This sandbox has no running WordPress or WooCommerce install, database,
or browser to test against, so the following are **not yet verified on a
live site** and should be checked there before considering the theme
production-ready:

- Actual rendered appearance against the (not-yet-provided) `screenshot.png`
  reference — the user indicated they will attach the real file later; no
  screenshot exists in the repository yet, so the visual direction was
  interpreted purely from the written brief.
  Do not generate, replace, or delete `screenshot.png`.
- End-to-end WooCommerce flows: shop listing, product filtering, variable
  product selection, add-to-cart, cart, checkout, order placement, My
  Account/order history, product search.
- Responsive/mobile behavior in an actual browser (only reviewed the CSS
  logic, not rendered viewport behavior).
- Comment posting/threading, and any active plugins' interaction with the
  `woocommerce/content-product.php` hook usage.
- WordPress Site Health / theme-check style automated compatibility
  checks (not run, no WP install available).

Next step once a screenshot and/or a live WP+WooCommerce environment is
available: visual pass against the reference image, then the full
end-to-end WooCommerce testing pass listed above.
