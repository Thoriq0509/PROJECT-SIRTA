<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Cek apakah role user adalah 'admin'
        if (Auth::user()->role === 'admin') {
            return $next($request); // Loloskan
        }

        // 3. Jika login tapi BUKAN admin (misal: warga), lempar error 403
        // Atau kamu bisa ganti abort(403) ini jadi: return redirect()->route('warga.dashboard');
        abort(403, 'Anda tidak memiliki akses admin.');
    }
}