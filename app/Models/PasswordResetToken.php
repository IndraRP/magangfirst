<?php
// app/Models/PasswordResetToken.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    protected $primaryKey = 'email';
    public $incrementing = false;
    public $timestamps = false;
}