<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMetric extends Model
{
    protected $fillable = ['project_id', 'metric_key', 'metric_label', 'metric_value', 'metric_unit', 'verified', 'sort_order'];

    protected $casts = [
        'metric_value' => 'decimal:2',
        'verified' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}