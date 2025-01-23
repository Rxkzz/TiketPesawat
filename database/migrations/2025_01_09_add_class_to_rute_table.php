<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rute', function (Blueprint $table) {
            $table->foreignId('id_class')->nullable()->constrained('class', 'id_class')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('rute', function (Blueprint $table) {
            $table->dropForeign(['id_class']);
            $table->dropColumn('id_class');
        });
    }
}; 