<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Project: Prasi Aksesoris Bali

This application is a Laravel + Tailwind CSS project customized to present a minimalist Balinese accessory brand experience.

### Brand Design System

## Price Column Precision Change

On 2025-11-08 the `products.price` column was altered from `DECIMAL(10,2)` to `DECIMAL(12,2)` to fix a `SQLSTATE[22003] Numeric value out of range` error when inserting large prices (values with more than 8 digits before the decimal point). The new precision supports prices up to `9,999,999,999.99`.

Related changes:

-   Migration: `2025_11_08_000006_alter_products_price_precision.php`
-   Validation updated in `App\Http\Controllers\Admin\ProductController` to enforce `max:9999999999.99`.

If you need even larger values in the future, consider increasing to `DECIMAL(15,2)` or storing integer cents in an `UNSIGNED BIGINT` for performance and accuracy.

Primary palette (configured in `tailwind.config.js` under `theme.extend.colors.brand`):

| Token       | Hex       | Usage                                  |
| ----------- | --------- | -------------------------------------- |
| brand.white | `#FFFFFF` | Base surfaces / contrast with navy     |
| brand.navy  | `#0B1E3D` | Primary text, headings, strong accents |
| brand.gold  | `#D4AF37` | Accent, CTAs, key dividers             |
| brand.sand  | `#F5F3EE` | Page background (soft neutral)         |
| brand.stone | `#E6E1D5` | Borders, subtle separators             |

Extended utilities:

-   Shadows: `shadow-subtle`, `shadow-elevated`
-   Backgrounds: `bg-brand-radial`, `bg-brand-gradient`

### Blade Components

| Component    | File                                                | Purpose                                               |
| ------------ | --------------------------------------------------- | ----------------------------------------------------- |
| Navigation   | `resources/views/components/nav.blade.php`          | Responsive header, language switcher                  |
| Footer       | `resources/views/components/footer.blade.php`       | Global footer with dynamic social / marketplace links |
| Section Card | `resources/views/components/section-card.blade.php` | Reusable card wrapper (title, subtitle, slot)         |

Use the section card:

```blade
<x-section-card title="Etnik Modern" subtitle="Sentuhan budaya Bali">Custom content...</x-section-card>
```

### Internationalization (i18n)

Languages supported: Indonesian (default), English.

Translation strategy:

-   JSON translation files: `resources/lang/id.json`, `resources/lang/en.json`.
-   Wrap visible strings in `__('...')`.
-   Language switch route: `GET /lang/{locale}` (`id`, `en`).
-   Locale stored in session (set in `AppServiceProvider::boot`).

Add a new key: put the Indonesian phrase in `id.json`, its English equivalent in `en.json`, then call `__('Phrase')` in Blade.

### Updating Styles

Tailwind build commands:

```bash
pnpm run dev      # or npm run dev / yarn dev
pnpm run build    # production assets
```

Ensure any new Blade file path falls under `resources/views/**` so classes are not purged.

### Data Shared Globally

`AppServiceProvider` shares:

-   `$socialMedia` (active social links)
-   `$ecommerceLinks` (active marketplace links)

Both collections are optional; Blade templates guard with `isset()`.

### Directory Highlights

-   `resources/views/layouts/app.blade.php` – Base layout using `<x-nav />` and `<x-footer />`.
-   `resources/views/home.blade.php` – Hero + featured sections.
-   `resources/views/pages/` – Secondary content pages (about, products, contact).

### Adding a New Page

1. Create Blade file in `resources/views/pages/yourpage.blade.php`.
2. Add route in `routes/web.php`.
3. Use `@extends('layouts.app')` and define `@section('content')`.
4. Wrap strings with `__()` for translation.

### Example Minimal Page

```blade
@extends('layouts.app')
@section('title', 'Galeri')
@section('content')
	<div class="max-w-5xl mx-auto px-4 md:px-8 py-16">
		<h1 class="text-3xl font-semibold text-brand-navy mb-6">{{ __('Galeri') }}</h1>
		<p class="text-brand-navy/70">{{ __('Koleksi visual karya kami.') }}</p>
	</div>
@endsection
```

### Accessibility Notes

-   Sufficient contrast: navy (#0B1E3D) on white/sand backgrounds.
-   Gold used sparingly for accent (avoid large text blocks with gold on white).
-   Language links are short, use `EN` / `ID` labels.

### Future Improvements (Suggestions)

-   Add ARIA labels to navigation toggle.
-   Add product filtering component with accessible form controls.
-   Implement server-side caching for shared collections.

---

The base Laravel framework details are below for reference.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
