<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::with('postCategory');
        if (request()->has('categoria')) {
            $categoria = strtolower(request('categoria'));
            $query->whereHas('postCategory', function ($q) use ($categoria) {
                $q->whereRaw('LOWER(name) = ?', [$categoria]);
            });
        }
        return response()->json($query->orderBy('id', 'desc')->paginate());
    }

    public function show(Post $post)
    {
        $post->load('postCategory');
        return response()->json($post);
    }
}
