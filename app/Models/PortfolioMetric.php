<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioMetric extends Model
{
    protected $fillable = [
        'metric_key', 'metric_label', 'metric_value', 'metric_unit',
        'source_type', 'source_reference', 'verified', 'enabled', 'sort_order',
    ];

    protected $casts = [
        'metric_value' => 'decimal:2',
        'verified' => 'boolean',
        'enabled' => 'boolean',
    ];

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('verified', true);
    }
}