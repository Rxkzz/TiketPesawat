<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->string('status_pembayaran')->default('PENDING');
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('nama_penumpang');
            $table->string('nomor_identitas');
            $table->string('email');
            $table->string('nomor_telepon');
        });
    }

    public function down()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropColumn([
                'status_pembayaran',
                'payment_method',
                'payment_proof',
                'paid_at',
                'nama_penumpang',
                'nomor_identitas',
                'email',
                'nomor_telepon'
            ]);
        });
    }
}; 