<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index()
    {
        return response()->json(PostCategory::all());
    }

    public function show(PostCategory $postCategory)
    {
        return response()->json($postCategory);
    }
}
