<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserInterest;
use Illuminate\Http\Request;

class UserInterestController extends Controller
{
    public function index()
    {
        return response()->json(UserInterest::all());
    }

    public function show(UserInterest $userInterest)
    {
        return response()->json($userInterest);
    }
}
