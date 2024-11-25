<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleAdmin
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {
            // Jika role cocok, lanjutkan request
            if (Auth::user()->role === $role) {
                return $next($request);
            }

            // Jika role tidak sesuai, arahkan ke login
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses.');
        }

        // Jika pengguna belum login, arahkan ke login
        return redirect()->route('login')->with('error', 'Harap login terlebih dahulu.');
    }
}
