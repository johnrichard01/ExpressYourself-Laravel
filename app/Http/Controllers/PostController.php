<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
   
    public function create()
    {
        $categories = Category::all();
        return view('user.create', compact('categories'));
    }
    
}
