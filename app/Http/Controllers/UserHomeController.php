<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;

class UserHomeController extends Controller
{
    public function index()
    {
        // Fetch blogs
        $blogs = Blogs::latest()->get();

        $user = auth()->user();
        $latestBlog = Blogs::latest()->first();

        return view('user.home', compact('user', 'latestBlog', 'blogs', 'populars'));
    }
}