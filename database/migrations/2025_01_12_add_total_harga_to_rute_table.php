<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rute', function (Blueprint $table) {
            $table->integer('total_harga')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('rute', function (Blueprint $table) {
            $table->dropColumn('total_harga');
        });
    }
}; 