<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua pengguna.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user', compact('users'));  
    }
    

    /**
     * Tampilkan formulir untuk membuat pengguna baru.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Simpan pengguna baru ke database.
     */
    public function store(Request $request)
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
        return redirect()->route('admin_user')->with('success', 'User created successfully.');
    }

    /**
     * Tampilkan formulir untuk mengedit pengguna.
     */
    public function edit($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update data pengguna di database.
     */
    public function update(Request $request, $id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);
    
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Hindari duplikasi email
            'role' => 'required|in:admin,kasir', // Validasi untuk kolom role
            'password' => 'nullable|string|min:8|confirmed', // Validasi password opsional
        ]);
    
        // Update data pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // Update role
        ]);
    
        // Jika password diinput, update password
        if ($request->filled('password')) { // Cek apakah password diisi
            $user->update(['password' => bcrypt($request->password)]); // Enkripsi password
        }
    
        // Redirect setelah berhasil update
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Hapus pengguna dari database.
     */
    public function destroy($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);
        $user->delete(); // Hapus pengguna

        // Redirect setelah berhasil hapus
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
