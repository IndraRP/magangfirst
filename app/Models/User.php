<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan kolom role ke mass assignable
    ];


    // Menentukan kolom yang bisa diisi (mass assignment)

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Jika kolom ini sudah dihapus, hapus baris ini
    ];

    /**
     * Cek apakah user memiliki role admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user memiliki role kasir.
     *
     * @return bool
     */
    public function isKasir()
    {
        return $this->role === 'kasir';
    }
}
