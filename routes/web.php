<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Redirect;

Route::middleware(['auth'])->group(function () {

    Route::redirect('/', '/posts')->name('home');

    Route::resource('users', UserController::class)->except(['show'])->names('users');
    Route::put('/users/{user}/profile', [UserController::class, 'updateProfile'])->name('users.updateProfile');
    Route::put('/users/{user}/interest', [UserController::class, 'updateInterest'])->name('users.updateInterest');
    Route::put('/users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.updateRoles');
    Route::resource('posts', PostController::class)->except(['show'])->names('posts');
    Route::put('/posts/{post}/category', [PostController::class, 'updateCategory'])->name('posts.updateCategory');
    Route::resource('quiz', QuizController::class)->except(['show'])->names('quiz');
    // Route::fallback(function () {
    //     return redirect()->route('home');
    // });
});

Route::get('/private-image/{filename}', function ($filename) {
    // 1. Verifica se o arquivo existe no disco S3 (Cloudflare R2)
    if (Storage::disk('s3')->exists($filename)) {
        return Storage::disk('s3')->response($filename);
    }
    if (Storage::disk('s3')->exists('public/' . $filename)) {
        return Storage::disk('s3')->response('public/' . $filename);
    }

    // 3. Se não achar, erro 404
    abort(404);
});

Route::domain('{subdomain}.' . config('app.domain'))->middleware(['auth'])->group(function () {
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});

