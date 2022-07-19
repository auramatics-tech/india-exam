<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Announcement extends Model
{  
    use SoftDeletes;
    protected $table = 'announcements';
    protected $fillable = [
        'blog_id',
        'active'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function get_title()
    {
        return $this->hasOne(Blog::class, 'id', 'blog_id');
    }
}
