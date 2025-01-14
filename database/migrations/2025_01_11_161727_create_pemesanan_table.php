<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id('id_pemesanan');
            $table->string('kode_pemesanan');
            $table->date('tanggal_pemesanan');
            $table->string('tempat_pemesanan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('kode_kursi');
            $table->unsignedBigInteger('id_rute');
            $table->string('tujuan');
            $table->date('tanggal_berangkat');
            $table->time('jam_cekin');
            $table->time('jam_berangkat');
            $table->decimal('total_bayar', 10, 2);
            $table->unsignedBigInteger('id_petugas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
} 