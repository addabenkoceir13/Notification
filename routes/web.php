<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

// Route::view('/', 'welcome');
Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('/posts/{post}/approve', [PostController::class, 'approve'])->name('posts.approve');

Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::post('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
