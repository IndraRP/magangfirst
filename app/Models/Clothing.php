<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothing extends Model
{
    use HasFactory;

    // Menentukan kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'nama', 'foto', 'harga', 'stok',
    ];
}