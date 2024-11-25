<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email', // Validasi email
            'password' => 'required', // Validasi password
        ]);

        // Temukan pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah email dan password cocok
        if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            // Regenerasi sesi setelah login berhasil
            $request->session()->regenerate();

            // Buat token baru (jika Anda menggunakan token API)
            $token = $user->createToken('auth_token')->plainTextToken;

            if ($user->role === 'admin') {
                return redirect()->route('clothing')->with('token', $token);
            } elseif ($user->role === 'kasir') {
                return redirect()->route('kasir.dashboard')->with('token', $token);
            }

            // Jika role tidak terdefinisi, redirect ke home
            return redirect()->route('home')->with('token', $token);
        }

        // Jika gagal, kirim pesan error
        return back()->with('error', 'Your Email or Password is invalid');

    }

    public function Register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:2|confirmed',
            'role' => 'required|in:admin,kasir', // Validasi untuk kolom role
        ]);

        // Simpan data pengguna
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
            'role' => $request->role, // Simpan role
        ]);

        // Redirect ke halaman login setelah berhasil membuat akun
        return redirect()->route('login');
    }

    
    // Logout method
    public function logout(Request $request)
{
    // Logout pengguna
    Auth::logout();

    // Hapus session pengguna
    $request->session()->invalidate();
    
    // Regenerasi session ID untuk menghindari serangan session fixation
    $request->session()->regenerateToken();

    // Redirect ke halaman login atau halaman utama
    return redirect()->route('login');
}


}
