<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function aboutus(){
        return view('homepage.aboutus');
    }
}
