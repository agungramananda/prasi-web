<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('spaces:test-upload', function () {
    $disk = config('filesystems.default');
    if ($disk !== 'digitalocean') {
        $this->error("Default filesystem disk is '{$disk}', not 'digitalocean'. Set FILESYSTEM_DISK=digitalocean in .env to test.");
        return 1;
    }

    $path = 'health/health-'.date('Ymd-His').'.txt';
    $content = 'Spaces health check at '.now()->toDateTimeString();

    try {
        Storage::disk('digitalocean')->put($path, $content);
    } catch (\Throwable $e) {
        $this->error('Upload failed: '.$e->getMessage());
        return 1;
    }

    // Build URL (public delivery domain)
    $url = Storage::disk('digitalocean')->url($path);
    $existsText = 'unknown';
    try {
        $existsText = Storage::disk('digitalocean')->exists($path) ? 'yes' : 'no';
    } catch (\Throwable $e) {
        // Don't fail the command on existence check issues; often caused by bad endpoint.
        $existsText = 'error: '.$e->getMessage();
    }

    $this->info('Uploaded test file to DigitalOcean Spaces.');
    $this->line('Path: '.$path);
    $this->line('Exists (API check): '.$existsText);
    $this->line('Public URL: '.$url);
    $this->comment('Open the URL in your browser. If 404, check bucket policy or visibility.');
    $this->comment('If upload repeatedly fails, temporarily set throw=>true on disk config to surface errors.');
    return 0;
})->purpose('Uploads a small health file to DigitalOcean Spaces and outputs the public URL');
