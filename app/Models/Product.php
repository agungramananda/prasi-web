<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
        'is_featured',
        'is_active'
    ];

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
