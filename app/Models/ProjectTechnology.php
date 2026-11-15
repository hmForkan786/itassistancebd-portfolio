<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTechnology extends Model
{
    public $timestamps = false;

    protected $fillable = ['project_id', 'name', 'sort_order'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}