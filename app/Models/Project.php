<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'category', 'short_description', 'description', 'purpose',
        'problem_statement', 'solution', 'implementation_details', 'results', 'limitations',
        'client_name', 'client_visibility', 'status', 'featured', 'sort_order',
        'started_at', 'completed_at', 'duration', 'live_url', 'github_url',
        'seo_title', 'seo_description', 'published_at',
    ];

    protected $casts = [
        'client_visibility' => 'boolean',
        'featured' => 'boolean',
        'started_at' => 'date',
        'completed_at' => 'date',
        'published_at' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function technologies()
    {
        return $this->hasMany(ProjectTechnology::class)->orderBy('sort_order');
    }

    public function metrics()
    {
        return $this->hasMany(ProjectMetric::class)->orderBy('sort_order');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}