<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate and update profile fields
        $request->validate([
            'new_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'max:255',
            'city' => 'max:255',
        ]);

        // Handle new avatar upload
        if ($request->hasFile('new_avatar')) {
            // Delete existing avatar
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Upload new avatar
            $avatarPath = $request->file('new_avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Update other fields individually
        $user->bio = $request->input('bio');
        $user->username = $request->input('username');
        $user->gender = $request->input('gender');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->city = $request->input('city');

        $user->update();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function show($username)
    {
        $user = User::where('username', $username)->with('posts')->firstOrFail();
        return view('profile', ['user' => $user]);
    }
    public function profile_admin()
    {
        $currentUser = auth()->user();
        $unreadCount = Contact::where('status', 'unread')->count();
        return view('admin.admin-profile', compact('currentUser', 'unreadCount'));
    }
    public function show_changepassword()
    {
        $user = Auth::user();
        if(Auth::check())
        {
            if(Auth::user()->role_as == '1')
            {
                return redirect('/dashboard');
            }
            else if(Auth::user()->role_as == '0')
            {
                return view('user.changepassword',[
                    'user'=>$user
                ]);
            }
        }
        else
        {
            return view('user.changepassword',[
                'user'=>$user
            ]);
        }
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'old_password'=>'required|min:8|max:100',
            'new_password'=>'required|min:8|max:100',
            'confirm_password'=>'required|same:new_password'
            ]);
    
            $current_user=auth()->user();
    
            if(Hash::check($request->old_password,$current_user->password)){
    
                $current_user->update([
                    'password'=>bcrypt($request->new_password)
                ]);
    
                return redirect()->back()->with('success','Password successfully updated.');
    
            }else{
                return redirect()->back()->with('error','Old password does not matched.');
            }
    }
    public function show_changepasswordadmin()
    {
        $currentUser = Auth::user();
        $unreadCount = Contact::where('status', 'unread')->count();
        return view('admin.changepassword-admin',[
            'currentUser'=>$currentUser,
            'unreadCount'=>$unreadCount
        ]);
    }
}
