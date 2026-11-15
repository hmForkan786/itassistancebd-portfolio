<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message', 'source_page',
        'status', 'admin_notes', 'submitted_at', 'read_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }
}