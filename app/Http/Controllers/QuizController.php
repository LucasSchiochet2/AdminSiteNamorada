<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $quiz = Quiz::query();
        $quiz->when(
            $request->keyword,
            function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', '%' . $keyword . '%');
                });
            }
        );
        $quiz = $quiz->paginate();
        return view('quiz.index', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('edit', User::class);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|',
            'answers' => 'required|array',
        ]);

        Quiz::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'answers' => $validatedData['answers'],
        ]);

        return redirect()->route('quiz.index')->with('status', 'Quiz created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        Gate::authorize('edit', User::class);
        return view('quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        Gate::authorize('edit', User::class);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|',
            'answers' => 'required|array',
        ]);

        $quiz->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'answers' => $validatedData['answers'],
        ]);

        return redirect()->route('quiz.index')->with('status', 'Quiz updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        Gate::authorize('edit', User::class);
        $quiz->delete();
        return redirect()->route('quiz.index')->with('status', 'Quiz deleted successfully!');
    }
}
