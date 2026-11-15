<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioEvent extends Model
{
    protected $fillable = [
        'event_name', 'page_path', 'project_id', 'session_hash',
        'referrer_domain', 'device_type', 'occurred_at',
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}