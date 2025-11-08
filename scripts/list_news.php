<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\News;

$rows = News::orderBy('id')->get()->map(function($n){
    return [
        'id' => $n->id,
        'title' => $n->title,
        'slug' => $n->slug,
        'is_active' => $n->is_active,
        'published_at' => $n->published_at? $n->published_at->toDateTimeString() : null,
    ];
});

echo json_encode($rows, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

