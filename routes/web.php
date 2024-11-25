<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ClothingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; // Pastikan Anda memiliki LoginController
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckRoleAdmin;
use App\Livewire\ClothingManager;
use App\Livewire\User;
use App\Livewire\UserManager;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk admin
Route::middleware(['auth', CheckRoleAdmin::class . ':admin'])->group(function () {
    // Route::get('/admin/dashboard', function () {return view('admin.home');})->name('admin.dashboard');
    
    // Route::get('/admin_user', [UserController::class, 'index'])->name('users.index'); // Menampilkan semua user
    // Route::get('/create', [UserController::class, 'create'])->name('users.create'); // Halaman form create user
    // Route::post('/', [UserController::class, 'store'])->name('users.store'); // Menyimpan data user baru
    // Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // Halaman edit user
    // Route::put('/{id}', [UserController::class, 'update'])->name('users.update'); // Update user
    // Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Menghapus user
    
    Route::get('/user', UserManager::class ) -> name('user');
    Route::get('/clothing', ClothingManager::class ) -> name('clothing');

});

// Rute untuk kasir
Route::middleware(['auth', CheckRole::class . ':kasir'])->group(function () {
    Route::get('/kasir/dashboard', function () {return view('kasir.kasir');})->name('kasir.dashboard');

});



// Routing untuk Login
Route::get('/login', function () {return view('page.login'); })->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout.submit');

// Routing untuk Register
Route::get('/register', function () {return view('page.register'); })->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.submit');