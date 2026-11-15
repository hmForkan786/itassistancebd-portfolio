<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_name', 'client_role', 'company_name', 'client_avatar',
        'project_id', 'review_text', 'rating', 'review_date',
        'verified', 'approved', 'published', 'featured', 'sort_order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'review_date' => 'date',
        'verified' => 'boolean',
        'approved' => 'boolean',
        'published' => 'boolean',
        'featured' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeEligible($query)
    {
        return $query->where('approved', true)->where('published', true)->where('verified', true);
    }
}