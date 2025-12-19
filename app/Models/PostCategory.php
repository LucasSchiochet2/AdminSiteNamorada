<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
class PostCategory extends Model
{
    use HasFactory;
    protected $table = 'post_category';
    protected $fillable = ['post_id', 'name'];
}
