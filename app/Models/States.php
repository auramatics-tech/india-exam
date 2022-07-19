<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class States extends Model
{  
    protected $table = 'state_list';
    protected $fillable = [
        'state'
    ];
    
}
