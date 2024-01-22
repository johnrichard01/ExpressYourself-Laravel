<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index(){
        $latestBlog = Blogs::latest()->first();
        $blogs=Blogs::where('id', '!=', $latestBlog->id)->latest()->simplePaginate(4);
        return view('homepage.index', compact('blogs','latestBlog'));
    }
}
