<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;

//show homepage
Route::get('/', [BlogsController::class, 'index']);
//about us
Route::get('/aboutus',[StaticPageController::class, 'aboutus']);
//contact us
