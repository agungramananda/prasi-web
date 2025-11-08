<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'price',
        'image',
        'category',
        'is_featured',
        'is_active'
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                // Prefer translated name when available (Spatie Translatable)
                try {
                    $name = method_exists($product, 'getTranslation') ? $product->getTranslation('name', app()->getLocale()) : ($product->name ?? null);
                } catch (\Exception $e) {
                    $name = $product->name ?? null;
                }
                $product->slug = static::generateUniqueSlug($name ?: (string) time());
            }
        });

        static::updating(function ($product) {
            // If slug is empty and name changed, regenerate slug
            if (empty($product->slug) && $product->isDirty('name')) {
                try {
                    $name = method_exists($product, 'getTranslation') ? $product->getTranslation('name', app()->getLocale()) : ($product->name ?? null);
                } catch (\Exception $e) {
                    $name = $product->name ?? null;
                }
                $product->slug = static::generateUniqueSlug($name ?: (string) time());
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

    public $translatable = [
        'name',
        'description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // If using DigitalOcean Spaces or S3, use Storage::url()
        if (config('filesystems.default') === 'digitalocean') {
            return Storage::disk('digitalocean')->url($this->image);
        }

        // For local/public disk, use asset()
        return asset('storage/' . $this->image);
    }
}
