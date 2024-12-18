<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom role dengan default 'kasir'
            $table->enum('role', ['admin', 'kasir'])->default('kasir')->after('password');
            
            // Hapus kolom email_verified_at
            $table->dropColumn('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kembali kolom email_verified_at
            $table->timestamp('email_verified_at')->nullable();

            // Hapus kolom role
            $table->dropColumn('role');
        });
    }
};
