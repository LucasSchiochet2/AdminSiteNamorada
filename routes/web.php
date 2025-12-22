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
    // 1. Tenta descobrir onde o código acha que o arquivo está
    $pathPrivate = storage_path('app/private_images/' . $filename);
    $pathPublic = storage_path('app/public/' . $filename);
    $pathRaiz = storage_path('app/' . $filename);

    return response()->json([
        'debug' => 'TESTE DE CAMINHO',
        'arquivo_solicitado' => $filename,
        'onde_estou_procurando_1' => $pathPrivate,
        'existe_no_caminho_1?' => file_exists($pathPrivate),
        'onde_estou_procurando_2' => $pathPublic,
        'existe_no_caminho_2?' => file_exists($pathPublic),
        'onde_estou_procurando_3' => $pathRaiz,
        'existe_no_caminho_3?' => file_exists($pathRaiz),
        // Lista o que REALMENTE tem na pasta storage/app
        'arquivos_na_pasta_storage_app' => scandir(storage_path('app')),
    ]);
});

Route::domain('{subdomain}.' . config('app.domain'))->middleware(['auth'])->group(function () {
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});

