<?php

use App\Http\Controllers\BlogsController;
use Illuminate\Support\Facades\Route;

//show homepage
Route::get('/', [BlogsController::class, 'index']);
