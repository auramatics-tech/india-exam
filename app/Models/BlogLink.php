<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BlogLink extends Model
{  
    protected $table = 'blog_links';
    protected $fillable = [
        'blog_id',
        'blog_id',
        'link',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
