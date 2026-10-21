Optional self-hosted vendor scripts
===================================

Drop any of these files here and the theme will load them from your own server
instead of a CDN. No code changes are needed - sgz_tailwind_src() and
sgz_vendor_src() in inc/enqueue.php check for these filenames on every request.

  tailwind.js              Tailwind browser runtime (the same file your static
                           site loads today)
  alpine.min.js            Alpine.js 3.x core
  alpine-collapse.min.js   Alpine.js collapse plugin

Load order is handled by the theme: the Tailwind config is injected inline
immediately after tailwind.js, and Alpine is deferred so it initialises after
the config and the theme store are in place.
