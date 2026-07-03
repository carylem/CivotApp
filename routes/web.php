<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return redirect('/projects');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/projects', [ProjectController::class, 'index'])
        ->name('projects.index');

    Route::post('/projects/{project}/vote', [VoteController::class, 'store'])
        ->name('projects.vote');

    Route::post('/projects/{project}/comment', [CommentController::class, 'store'])
        ->name('projects.comment');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';