<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'photo'];

    public function postCategory()
    {
        return $this->hasOne(PostCategory::class);
    }
}
