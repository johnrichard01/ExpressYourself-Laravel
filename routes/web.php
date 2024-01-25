<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StaticPageController;

//show homepage
Route::get('/', [BlogsController::class, 'index']);
//about us
Route::get('/aboutus',[StaticPageController::class, 'aboutus']);
//show signup
Route::get('/signup',[UsersController::class, 'create'])->middleware('guest');
//create new user
Route::post('/users', [UsersController::class, 'store']);
//show login
Route::get('/login', [UsersController::class, 'login'])->name('login')->middleware('guest');
//login function
Route::post('/login/authenticate', [UsersController::class, 'authenticate']);
//logout functionality
Route::post('/logout', [UsersController::class, 'logout'])->middleware('auth');
//show dashboard
Route::get('/dashboard', [UsersController::class, 'dashboard'])->middleware(['auth', 'isAdmin']);
//redirect to admin or uer
