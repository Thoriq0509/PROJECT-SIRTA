<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $loginData = [
            $field => $credentials['login'],
            'password' => $credentials['password'],
            'role' => 'admin',
        ];

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withErrors([
                'login' => 'Username/email atau password salah.',
            ])
            ->withInput($request->only('login'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}