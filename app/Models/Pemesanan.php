<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';

    protected $fillable = [
        'kode_pemesanan',
        'tanggal_pemesanan',
        'tempat_pemesanan',
        'id_pelanggan',
        'kode_kursi',
        'id_rute',
        'tujuan',
        'tanggal_berangkat',
        'jam_cekin',
        'jam_berangkat',
        'total_bayar',
        'id_petugas',
    ];

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }
} 