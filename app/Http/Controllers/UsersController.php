<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    //show the signup page
    public function create()
    {
        return view('homepage.signup');
    }
    //for storing new users
    public function store(Request $request){
        $formFields = $request->validate([
            'username'=> ['required', 'min:3', Rule::unique('users', 'username')],
            'email'=>['required', 'email', Rule::unique('users', 'email')],
            'password'=>['required', 'confirmed']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        User::create($formFields);
        return redirect('/');
    }
    //show login
    public function login()
    {
        return view('homepage.login');
    }
    //login functionality
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email'=>['required', 'email'],
            'password'=>['required']
        ]);
        if(auth()->attempt($formFields))
        {
            $request->session()->regenerate();

            return redirect('/');
        }
        return back()->withErrors(['credentials'=>'Invalid Credentials']);
    }
    //for logout
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    //show dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
