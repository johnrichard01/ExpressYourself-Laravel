<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaticPageController extends Controller
{
    public function aboutus(){
        if(Auth::check())
        {
            if(Auth::user()->role_as == '1')
            {
                return redirect('/dashboard');
            }
            else if(Auth::user()->role_as == '0')
            {
                return view('homepage.aboutus');
            }
        }
        else
        {
            return view('homepage.aboutus');
        }
        
    }
}
