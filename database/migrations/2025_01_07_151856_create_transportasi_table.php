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
        Schema::create('transportasi', function (Blueprint $table) {
            $table->id('id_transportasi');
            $table->string('kode');
            $table->text('keterangan')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('id_type_transportasi')->constrained('type_transportasi', 'id_type_transportasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportasi');
    }
};
