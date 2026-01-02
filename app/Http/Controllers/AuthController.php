<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.signin');
    }

    public function login(UserRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role->role_name === 'Faculty') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/student/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Remove all data from the session
        $request->session()->invalidate();

        // Regenerate csrf token for next session
        $request->session()->regenerate();

        return redirect()->route('show.login');
    }
}
