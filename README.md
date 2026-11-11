# Prasi Aksesoris Bali

Prasi Aksesoris Bali is a bilingual Laravel website for showcasing and managing
Balinese accessories and lontar-leaf souvenirs. The public site presents the
brand story, product collection, news, contact information, and links to online
marketplaces. An authenticated admin area manages the site's content.

## Features

- Responsive public storefront with home, about, products, product detail,
  news, and contact pages.
- Indonesian and English translations with a session-based language switcher.
- Product catalog with translated names and descriptions, categories, prices,
  images, featured products, and active/inactive status.
- News publishing with translated titles and content, tags, header images, and
  optional publication dates.
- Admin dashboard for products, news, social media links, marketplace links,
  and contact messages.
- Contact form protected by request throttling.
- Local storage or S3-compatible object storage for uploaded images.
- Tailwind CSS design tokens based on Prasi's navy, gold, sand, and stone
  palette.

## Technology

- PHP 8.2+
- Laravel 12
- SQLite by default (other Laravel database drivers can be configured)
- Blade templates, Alpine.js, and Vite
- Tailwind CSS
- Spatie Laravel Translatable
- PHPUnit

## Requirements

Install the following before setting up the project:

- PHP 8.2 or newer
- Composer
- Node.js and npm
- SQLite (or another database supported by Laravel)

## Installation

Clone the repository and install the backend and frontend dependencies:

```bash
git clone <repository-url>
cd prasi-web
composer install
npm install
```

Create the environment file, generate an application key, and prepare the
database:

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
```

For local image uploads, create the public storage link:

```bash
php artisan storage:link
```

Set the application URL and any database, mail, storage, or admin settings in
`.env`. The default configuration uses SQLite, a database-backed queue/cache,
and the log mail driver.

## Running locally

Run the complete development environment:

```bash
composer run dev
```

This starts the Laravel server, queue listener, log viewer, and Vite dev
server. Alternatively, run the services separately:

```bash
php artisan serve
npm run dev
```

Build production frontend assets with:

```bash
npm run build
```

## Application routes

| Route | Description |
| --- | --- |
| `/` | Home page |
| `/about` | Brand story and values |
| `/products` | Active product collection |
| `/products/{slug}` | Product details |
| `/news` | Published news |
| `/news/{slug}` | News article details |
| `/contact` | Contact form and contact information |
| `/lang/{locale}` | Switch between `id` and `en` |
| `/admin/dashboard` | Authenticated administration dashboard |

Admin resource management is available under `/admin` for products, news,
social media, marketplace links, and contact messages. Admin routes require
authentication and verified email status.

## Content and translations

Visible UI strings use Laravel's translation helper:

```blade
{{ __('Produk Kami') }}
```

The Indonesian and English JSON translation files are located at:

- `resources/lang/id.json`
- `resources/lang/en.json`

Product and news names/content use Spatie Laravel Translatable and can be
entered per supported locale from the admin interface.

## Project structure

```text
app/
  Http/Controllers/       Public and admin request handling
  Models/                 Product, News, contact, and link models
  Providers/              Shared view data and application bootstrapping
database/
  migrations/             Database schema
  seeders/                Optional initial data
resources/
  views/                  Public, admin, auth, and reusable Blade views
  css/                    Tailwind entry styles
  js/                     Vite/Alpine frontend entry point
routes/
  web.php                 Public and admin web routes
  auth.php                Authentication routes
public/
  build/                  Compiled frontend assets
  storage/                Public storage link target
```