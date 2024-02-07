<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifyController;

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
Route::get('/blogs/create', [BlogsController::class, 'create'])->middleware(['auth', 'verified']);
//store created blogs
Route::post('/blogs/create/store', [BlogsController::class, 'store'])->middleware(['auth', 'verified']);
// show contact us
Route::get('/contact', [ContactController::class, 'show']);
//show edit form for blogs
Route::get('/blogs/{blogs}/edit', [BlogsController::class, 'show_update'])->middleware(['auth', 'verified']);
//update blogs
Route::post('/blogs/{blogs}', [BlogsController::class, 'update'])->middleware(['auth', 'verified']);
//delete blogs
Route::delete('/blogs/{blogs}', [BlogsController::class, 'destroy'])->middleware(['auth', 'verified']);
// show single blogs
Route::get('/blogs/{blog}', [BlogsController::class, 'show']);


// user
Route::get('/activities', [ActivityController::class, 'activity']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});
//for email verification
Route::get('/email/verify', [VerifyController::class, 'send'])->middleware('auth')->name('verification.notice');
//for verifying the email
Route::get('/email/verify/{id}/{hash}',[VerifyController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
//for resending email verification
Route::post('/email/verification-notification',[VerifyController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');