<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quiz';
    protected $fillable = ['title', 'body', 'answers'];

    protected $casts = [
        'answers' => 'array',
    ];
}
