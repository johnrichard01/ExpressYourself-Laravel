<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blogs;
use App\Models\Contact;
use App\Models\subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //show analytics page
    public function show_analytics()
    {
        $currentUser=Auth::user();
        $userCount= User::where('role_as', 0)->count();
        $contactCount= Contact::count();
        $subscriberCount= subscriber::count();
        $blogCount= Blogs::count();
        return view('admin.dashboard', [
            'userCount'=>$userCount,
            'contactCount'=>$contactCount,
            'subscriberCount'=>$subscriberCount,
            'blogCount'=>$blogCount,
            'currentUser'=>$currentUser
        ]);
    }
    public function show_user()
    {
        $currentUser=Auth::user();
        $users = User::where('role_as', 0)->get();
        return view('admin.manage-user', [
            'users'=>$users,
            'currentUser'=>$currentUser
        ]);
    }
    public function show_admin()
    {
        $currentUser=Auth::user();
        $users = User::where('role_as', 1)->get();
        return view('admin.manage-user', [
            'users'=>$users,
            'currentUser'=>$currentUser
        ]);
    }
}
