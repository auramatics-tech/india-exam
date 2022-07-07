<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model
{
    use SoftDeletes;
    protected $table = 'questions';
    protected $fillable = [
        'type',
        'question',
        'solution',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function get_answers()
    {
        return $this->hasMany(Answers::class, 'question_id', 'id');
    }
    public function get_correct_answer(){
        return $this->hasOne(Answers::class, 'question_id', 'id')->where('is_corrected',1);
    }
    public function get_topics()
    {
        return $this->hasOne(Category::class, 'id', 'topics');
    }
    public function get_subcategory()
    {
        return $this->hasOne(Category::class, 'slug', 'subcategory');
    }
    public function get_category()
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }
    public function get_question_category(){
        return $this->hasMany(Questioncategories::class, 'question_id', 'id');
    }
}
