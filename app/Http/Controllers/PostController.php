<?php

namespace App\Http\Controllers;

use App\Models\Photos;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::query();
        $posts->when($request->keyword,
            function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', '%'. $keyword .'%');
                });
        });
        $posts = $posts->paginate();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('edit', User::class);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'photo' => 'nullable|file|image|max:10048',
        ]);

        $data = [
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
        ];

        if(!empty($validatedData['photo']) && $validatedData['photo']->isValid()) {
            $data['photo'] = $validatedData['photo']->store();
        }

        Post::create($data);
        

        return redirect()->route('posts.index')->with('status', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('edit', User::class);
        $categories = PostCategory::select('name')->distinct()->get();
        // Lógica para mostrar o formulário de edição de usuário
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('edit', User::class);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'photo' => 'nullable|file|image|max:10048',
        ]);

        $data = [
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
        ];

        if(!empty($validatedData['photo']) && $validatedData['photo']->isValid()) {
            $data['photo'] = $validatedData['photo']->store();
        }

        $post->update($data);

        return redirect()->route('posts.index') ->with('status', 'Post updated successfully!');
    }

    public function updateCategory(Request $request, Post $post)
    {
        Gate::authorize('edit', User::class);
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
        ]);

        $postCategory = $post->postCategory;
        if ($postCategory) {
            $postCategory->name = $validatedData['category'];
            $postCategory->save();
        } else {
            $post->postCategory()->create([
                'name' => $validatedData['category'],
            ]);
        }

        return redirect()->route('posts.index')->with('status', 'Post category updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('edit', User::class);
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Post deleted successfully!');
    }
}
