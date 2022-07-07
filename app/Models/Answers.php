<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Answers extends Model
{  
    protected $table = 'answers';
    protected $fillable = [
        'answers',
        'question_id',
        'is_corrected',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
