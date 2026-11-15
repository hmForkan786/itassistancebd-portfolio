<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'icon', 'featured',
        'sort_order', 'enabled', 'seo_title', 'seo_description',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'enabled' => 'boolean',
    ];

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true)->orderBy('sort_order');
    }
}