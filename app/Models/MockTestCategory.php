<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MockTestCategory extends Model

{
    use SoftDeletes;
    protected $table = 'mock_test_categories';
    protected $fillable = [
        'name',
        'parent_id',
        'type',
        'active',
        'slug'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function get_subcategory()
    {
        return $this->hasMany(MockTestCategory::class, 'parent_id', 'id')->where('active', 1)->orderby("sort",'asc');
    }
    public function get_parent_id()
    {
        return $this->hasOne(MockTestCategory::class, 'id', 'parent_id');
    }
}
