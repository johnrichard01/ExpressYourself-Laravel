<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    public function index(){
        $latestBlog = Blogs::latest()->first();
        $blogs=Blogs::where('id', '!=', $latestBlog->id)->latest()->simplePaginate(4);
        if(Auth::check())
        {
            if(Auth::user()->role_as == '1')
            {
                return redirect('/dashboard');
            }
            else if(Auth::user()->role_as == '0')
            {
                return view('homepage.index', compact('blogs','latestBlog'));
            }
        }
        else
        {
            return view('homepage.index', compact('blogs','latestBlog'));
        }
    }
}
