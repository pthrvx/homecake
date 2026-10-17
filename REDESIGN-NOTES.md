# HomeCake UI refresh

## Changes
- Reworked the public HomeCake landing page with a full-width responsive layout, stronger hierarchy, warm bakery palette, larger hero, quick trust indicators, featured product cards, best-seller showcase, occasion shortcuts, brand story, and order CTA.
- Rebuilt public navigation and footer; added a responsive mobile navigation toggle.
- Added gentle entrance, floating-card, hover, and image interactions, while honoring `prefers-reduced-motion`.
- Reworked the admin navigation and order/product list pages with clearer headings, dashboard KPI cards, filters, improved tables, empty states, and larger interaction targets.
- Added a best-seller section using illustrative demo content. It is explicitly labeled as demo content and should be replaced by real sales metrics when order/product sales tracking exists.
- Removed the machine-specific `.env` file from the package. Configure the project with `.env` locally from `.env.example`.

## Run locally
1. `composer install`
2. `cp .env.example .env` (configure database and other settings)
3. `php artisan key:generate`
4. `npm install`
5. `npm run build` (or `npm run dev` while developing)
6. `php artisan migrate --seed` if the project seeders are configured, then `php artisan serve`

Note: the existing uploaded `node_modules` did not contain Rollup's Linux optional dependency, so the Vite production build could not be verified in this environment. Run `npm install` on the target machine before building.
