<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'category', 'proficiency_label', 'icon', 'sort_order', 'enabled'];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true)->orderBy('category')->orderBy('sort_order');
    }
}