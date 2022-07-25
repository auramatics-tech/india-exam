<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussions extends Model
{
    use SoftDeletes;
    protected $table = 'discussions';
    protected $fillable = [
        'name',
        'email',
        'comments',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function get_question()
    {
        return $this->hasOne(Questions::class, 'id', 'question_id');
    }
}
