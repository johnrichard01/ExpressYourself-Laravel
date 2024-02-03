<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    //showing homepage
    public function index(){
        $latestBlog = Blogs::latest()->first();
        if ($latestBlog) {
            $blogs = Blogs::where('id', '!=', $latestBlog->id)->latest()->simplePaginate(4);
        } else if (!$latestBlog) {
            $blogs = Blogs::latest()->simplePaginate(4);
        }
        $user = Auth::user();
        if(Auth::check())
        {
            if(Auth::user()->role_as == '1')
            {
                return redirect('/dashboard');
            }
            else if(Auth::user()->role_as == '0')
            {
                return view('homepage.index', compact('blogs','latestBlog', 'user'));
            }
        }
        else
        {
            return view('homepage.index', compact('blogs','latestBlog', 'user'));
        }
    }
    //showing category
    public function category(){
        $category = request('category');
        return view('categories.category',[
            'category'=>ucfirst($category),
            'blogs'=>Blogs::latest()->filter(request(['category','search']))->simplePaginate(6),
        ]);
    }
    //serach function
    public function search(){
        $search = request('search');
        return view('categories.search',[
            'search'=>ucfirst($search),
            'blogs'=>Blogs::latest()->filter(request(['category','search']))->simplePaginate(6),
        ]);
    }
    //show single blogs
    public function show(Blogs $blog)
    {
        return view('homepage.show',[
            'blog'=>$blog
        ]);
    }

}
