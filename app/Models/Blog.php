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
        'blog_cat_id',
        'thumbnail_description',
        'description',
        'blog_pdf',
        'image',
        'state',
        'sort'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    
    public function get_category()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'blog_cat_id');
    }

    public function get_links()
    {
        return $this->hasMany(BlogLink::class, 'blog_id', 'id');
    }

    public function get_states()
    {
        return $this->hasOne(States::class, 'id', 'state');
    }

}
