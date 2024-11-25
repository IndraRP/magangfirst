<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClothingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clothing', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis sebagai primary key
            $table->string('nama'); // Kolom untuk nama pakaian
            $table->string('foto'); // Kolom untuk URL foto pakaian
            $table->decimal('harga', 10, 2); // Kolom harga dengan tipe decimal
            $table->integer('stok'); // Kolom untuk stok barang
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clothing');
    }
}
