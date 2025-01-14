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
        Schema::create('rute', function (Blueprint $table) {
             $table->id('id_rute');
            $table->string('tujuan');
            $table->string('rute_awal');
            $table->string('rute_akhir');
            $table->integer('harga');
            $table->foreignId('id_transportasi')->constrained('transportasi', 'id_transportasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rute');
    }
};
