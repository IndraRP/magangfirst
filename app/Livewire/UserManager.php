<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserManager extends Component
{
    public $userId, $name, $email, $password;
    public $role;  // Pastikan ini terikat pada model Livewire
    public $isEditing = false;

    // Menambahkan daftar role yang valid
    public $roles = ['admin', 'kasir'];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|in:admin,kasir', // Validasi role yang dipilih
        'password' => 'required|string|min:3', // Validasi password
    ];

    public function render()
    {
        $users = User::paginate(5); // Ambil semua user dengan pagination
        return view('livewire.user', compact('users'))
            ->extends('admin.user')
            ->section('body');
    }

    // Fungsi untuk menyimpan user baru
    public function storeUser()
    {
        $this->validate(); // Validasi data form

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role, // Simpan role yang dipilih
            'password' => bcrypt($this->password), // Hash password
        ]);

        session()->flash('message', 'User created successfully!');
        $this->resetFields();
        $this->dispatch('closeModal');
    }

    // Fungsi untuk mereset nilai form
    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->role = ''; // Reset role ke string kosong
        $this->password = ''; // Reset password
        $this->isEditing = false;
    }

    // Fungsi untuk menghapus user
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully!');
        } else {
            session()->flash('error', 'User tidak ditemukan!');
        }
    }

    // Fungsi untuk men-set nilai user yang akan diedit
    public function setUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->password = '';
            $this->isEditing = true;
            $this->dispatch('openModal');  // Tambahkan ini untuk membuka modal
        } else {
            session()->flash('error', 'User tidak ditemukan!');
        }
    }
    

    // Fungsi untuk mengupdate data user
    public function updateUser(){
        $this->validate();
        $user = User::find($this->userId); 

        if (!$user) {
            session()->flash('error', 'User tidak ditemukan!');
            return;
        }

        // Update user dengan data baru
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role, // Update role
            'password' => bcrypt($this->password), // Hash password jika diubah
        ]);

        session()->flash('message', 'User berhasil diperbarui!');
        $this->resetFields();
        $this->dispatch('closeModal');
    }
}
