<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class', function (Blueprint $table) {
            $table->id('id_class');
            $table->string('nama_class'); // Ekonomi, Bisnis, First Class
            $table->decimal('harga_tambahan', 10, 2); // Harga tambahan untuk kelas
            $table->text('keterangan')->nullable();
            $table->integer('bagasi');
            $table->boolean('hiburan')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_fasilitas');
        Schema::dropIfExists('class');
    }
}; 