<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::post('posts/{post}/like/{user}', [LikeController::class, 'store'])->name('likes.store');
Route::delete('posts/{post}/like/{user}', [LikeController::class, 'destroy'])->name('likes.destroy');
Route::post('posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');

