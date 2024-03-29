<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ForgotPasswordController extends Controller
{
    public function show()
    {
            return view('auth.forgot-password');
    }
    public function send(Request $request){

            $request->validate(['email' => 'required|email']);
         
            $status = Password::sendResetLink(
                $request->only('email')
            );
         
            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
    }
    public function show_reset(string $token)
    {
            return view('auth.reset-password', ['token' => $token]);
    }
    public function update(Request $request)
    {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);
         
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => bcrypt($password)
                    ]);
         
                    $user->save();
         
                    event(new PasswordReset($user));
                }
            );
         
            return $status === Password::PASSWORD_RESET
                        ? redirect()->route('login')->with('status', __($status))
                        : back()->withErrors(['email' => [__($status)]]);
    }
}
