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
    public function artwork(){
        return view('categories.artwork', ['blogs'=>Blogs::where('category', 'artwork')->latest()->simplePaginate(6)]);
    }
    public function craft(){
        return view('categories.craft', ['blogs'=>Blogs::where('category', 'craft')->latest()->simplePaginate(6)]);
    }

    public function literature(){
        return view('categories.literature', ['blogs'=>Blogs::where('category', 'literature')->latest()->simplePaginate(6)]);
    }
    public function photography(){
        return view('categories.photography', ['blogs'=>Blogs::where('category', 'photography')->latest()->simplePaginate(6)]);
    }

}
