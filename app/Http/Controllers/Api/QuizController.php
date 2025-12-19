<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        return response()->json(Quiz::paginate());
    }

    public function show(Quiz $quiz)
    {
        return response()->json($quiz);
    }
}
