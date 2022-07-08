<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends Model
{  
    use SoftDeletes;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'description',
        'blog_pdf',
        'image'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function get_links()
    {
        return $this->hasMany(BlogLink::class, 'blog_id', 'id');
    }

}
