<?php

// Boot Laravel framework and backfill product slugs for existing products.

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Support\Str;

echo "Starting slug backfill...\n";

Product::chunk(100, function ($rows) {
    foreach ($rows as $p) {
        if (empty($p->slug)) {
            // Prefer translated name when available
            try {
                $name = method_exists($p, 'getTranslation') ? $p->getTranslation('name', app()->getLocale()) : ($p->name ?? null);
            } catch (\Exception $e) {
                $name = $p->name ?? null;
            }
            $base = Str::slug($name ?: (string) $p->id);
            if ($base === '') {
                $base = (string) $p->id;
            }
            $slug = $base;
            $i = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $p->slug = $slug;
            $p->save();
            echo "Backfilled product id={$p->id} slug={$p->slug}\n";
        }
    }
});

echo "Done.\n";
