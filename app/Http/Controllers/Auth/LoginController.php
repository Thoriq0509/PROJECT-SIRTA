<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan form login Admin
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login khusus Admin
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
            'role' => 'admin', // Wajib role admin
        ];

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withErrors(['login' => 'Username/email atau password admin salah.'])
            ->withInput($request->only('login'));
    }

    // Tampilkan form login Warga
    public function showLoginWarga()
    {
        return view('auth.login-warga');
    }

    // Proses login khusus Warga (Bisa NIK atau Username)
    public function loginWarga(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah input berupa angka (NIK) atau teks (Username)
        $field = is_numeric($credentials['login']) ? 'nik' : 'username';

        $loginData = [
            $field => $credentials['login'],
            'password' => $credentials['password'],
            'role' => 'warga', // Wajib role warga
        ];

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();
            return redirect()->route('warga.dashboard'); 
        }

        return back()
            ->withErrors(['login' => 'NIK atau Username atau password salah.'])
            ->withInput($request->only('login'));
    }

    // Logout umum (Admin & Warga)
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}