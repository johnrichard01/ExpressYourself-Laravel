<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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
            // Add validation for other fields
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

        $user->update($request->all());

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}


