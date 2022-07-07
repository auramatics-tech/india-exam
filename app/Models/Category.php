<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model

{
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
        'is_navbar',
        'type',
        'sort'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function get_subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('active', 1)->orderby("sort",'asc');
    }

    public function subcategory1()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('type', 'Subcategory1')->where('active', 1);
    }

    public function subcategory2()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('type', 'Subcategory2')->where('active', 1);
    }

    public function topics()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->select('categories.*')->where('categories.type', 'Topics')
        ->join("questioncategory",'questioncategory.topic_id','categories.id')
        ->orderby("sort",'asc')
        ->where('active', 1);
    }

    public function get_navbar()
    {
        return $this->hasMany(Category::class, 'type', 'category')->where('active', 1);
    }
    public function get_question()
    {
        return $this->hasMany(Questions::class, 'topics', 'id');
    }
    public function get_parent_id()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
    public function get_topics()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('active', 1);
    }
    public function get_topic_subcategory()
    {
        return $this->hasMany(Questioncategories::class, 'topic_id', 'id');
    }

    
    public function first_question()
    {
        return $this->hasOne(Questioncategories::class, 'topic_id', 'id')->orderby('question_id','ASC');
    }
}
