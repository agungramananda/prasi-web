<?php

// Boot Laravel and backfill news: set published_at for null to now and generate slugs when missing.

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\News;
use Illuminate\Support\Str;

echo "Starting news backfill...\n";

// Set published_at to now for items that are active but missing published_at
$updatedPublished = 0;
News::whereNull('published_at')->get()->each(function ($n) use (&$updatedPublished) {
    $n->published_at = now();
    $n->save();
    $updatedPublished++;
});

echo "Published_at set for {$updatedPublished} records.\n";

// Generate slugs for records missing slug
$backfilled = 0;
News::whereNull('slug')->get()->each(function ($n) use (&$backfilled) {
    try {
        $title = method_exists($n, 'getTranslation') ? $n->getTranslation('title', app()->getLocale()) : ($n->title ?? null);
    } catch (\Exception $e) {
        $title = $n->title ?? null;
    }

    $base = Str::slug($title ?: (string) $n->id);
    if ($base === '') $base = (string) $n->id;

    $slug = $base;
    $i = 1;
    while (News::where('slug', $slug)->exists()) {
        $slug = $base . '-' . $i++;
    }

    $n->slug = $slug;
    $n->save();
    $backfilled++;
    echo "Backfilled news id={$n->id} slug={$n->slug}\n";
});

echo "Done. Backfilled {$backfilled} slugs.\n";
