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
        'active',
        'slug'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function first_question()
    {
        return $this->hasOne(MockTest::class, 'cat_id', 'id')->orderby('mock_test.id','asc');
    }
    
    public function all_question()
    {
        return $this->hasMany(MockTest::class, 'cat_id', 'id')->orderby('mock_test.id','asc');
    }
}
