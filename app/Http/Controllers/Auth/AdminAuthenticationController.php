<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthenticationController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->with('error', 'Login gagal, silakan coba lagi.');
    }
}
