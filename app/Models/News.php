<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class News extends Model
{
    use HasTranslations;
    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'header_image',
        'content',
        'tags',
        'is_active',
        'published_at',
    ];

    public $translatable = [
        'title',
        'content',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        // When feature flag is enabled, only items with published_at <= now() are considered published.
        // Otherwise, keep older behavior where null (unscheduled) is also visible.
        if (config('features.news_require_published_at')) {
            return $query->whereNotNull('published_at')->where('published_at', '<=', now());
        }
        return $query->whereNull('published_at')->orWhere('published_at', '<=', now());
    }

    protected static function booted()
    {
        static::creating(function ($news) {
            if (empty($news->slug)) {
                try {
                    $title = method_exists($news, 'getTranslation') ? $news->getTranslation('title', app()->getLocale()) : ($news->title ?? null);
                } catch (\Exception $e) {
                    $title = $news->title ?? null;
                }
                $news->slug = static::generateUniqueSlug($title ?: (string) time());
            }
        });

        static::updating(function ($news) {
            if (empty($news->slug) && $news->isDirty('title')) {
                try {
                    $title = method_exists($news, 'getTranslation') ? $news->getTranslation('title', app()->getLocale()) : ($news->title ?? null);
                } catch (\Exception $e) {
                    $title = $news->title ?? null;
                }
                $news->slug = static::generateUniqueSlug($title ?: (string) time());
            }
        });
    }

    protected static function generateUniqueSlug(string $value): string
    {
        $base = Str::slug($value);
        $slug = $base;
        $i = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    public function getHeaderImageUrlAttribute()
    {
        if (!$this->header_image) {
            return null;
        }

        if (config('filesystems.default') === 'digitalocean') {
            return \Illuminate\Support\Facades\Storage::disk('digitalocean')->url($this->header_image);
        }

        return asset('storage/' . $this->header_image);
    }
}
