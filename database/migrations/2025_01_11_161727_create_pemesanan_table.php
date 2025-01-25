<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id('id_pemesanan');
            $table->string('kode_pemesanan')->unique();
            $table->date('tanggal_pemesanan');
            $table->string('tempat_pemesanan')->default('Online');
            
            // Foreign key columns
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_rute');
            $table->unsignedBigInteger('id_petugas')->nullable();
            
            $table->string('kode_kursi');
            $table->string('tujuan');
            $table->date('tanggal_berangkat');
            $table->time('jam_cekin');
            $table->time('jam_berangkat');
            $table->decimal('total_bayar', 10, 2);
            $table->string('nama_penumpang');
            $table->string('nomor_identitas');
            $table->string('email');
            $table->string('nomor_telepon');
            $table->enum('status_pembayaran', ['PENDING', 'PAID'])->default('PENDING');
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_pelanggan')
                  ->references('id_penumpang')
                  ->on('penumpangs')
                  ->onDelete('restrict');

            $table->foreign('id_rute')
                  ->references('id_rute')
                  ->on('rute')
                  ->onDelete('restrict');

            $table->foreign('id_petugas')
                  ->references('id_petugas')
                  ->on('users')
                  ->onDelete('set null');

            // Indexes
            $table->index('kode_pemesanan');
            $table->index('tanggal_berangkat');
            $table->index('status_pembayaran');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
}; 