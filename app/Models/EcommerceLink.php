<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcommerceLink extends Model
{
    protected $fillable = [
        'name',
        'platform',
        'url',
        'icon',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
