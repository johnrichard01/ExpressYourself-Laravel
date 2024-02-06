<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GroupMessageController;
use App\Http\Controllers\ProfileController;


// show homepage
Route::get('/', [BlogsController::class, 'index']);
// about us
Route::get('/aboutus', [StaticPageController::class, 'aboutus']);
// show signup
Route::get('/signup', [UsersController::class, 'create'])->middleware('guest');
// create new user
Route::post('/users', [UsersController::class, 'store']);
// show login
Route::get('/login', [UsersController::class, 'login'])->name('login')->middleware('guest');
// login function
Route::post('/login/authenticate', [UsersController::class, 'authenticate']);
// logout functionality
Route::post('/logout', [UsersController::class, 'logout'])->middleware('auth');
// show dashboard
Route::get('/dashboard', [UsersController::class, 'dashboard'])->middleware(['auth', 'isAdmin']);
// show categories
Route::get('/category', [BlogsController::class, 'category']);
// search function
Route::get('/search', [BlogsController::class, 'search']);
//show create blogs form
Route::get('/blogs/create', [BlogsController::class, 'create'])->middleware('auth');
//store created blogs
Route::post('/blogs/create/store', [BlogsController::class, 'store'])->middleware('auth');
// show contact us
Route::get('/contact', [ContactController::class, 'show']);
//show edit form for blogs
Route::get('/blogs/{blogs}/edit', [BlogsController::class, 'show_update']);
//update blogs
Route::post('/blogs/{blogs}', [BlogsController::class, 'update']);
//delete blogs
Route::delete('/blogs/{blogs}', [BlogsController::class, 'destroy']);
// show single blogs
Route::get('/blogs/{blog}', [BlogsController::class, 'show']);
// show contact us
Route::get('/contact', [ContactController::class, 'show']);

// user
Route::get('/activities', [ActivityController::class, 'activity']);
Route::get('/messages', [MessageController::class, 'message']);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');



});
