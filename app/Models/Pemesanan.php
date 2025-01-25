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
        'nama_penumpang',
        'nomor_identitas',
        'email',
        'nomor_telepon',
        'status_pembayaran',
        'payment_method',
        'payment_proof',
        'paid_at'
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'date',
        'tanggal_berangkat' => 'date',
        'jam_cekin' => 'datetime',
        'jam_berangkat' => 'datetime',
        'paid_at' => 'datetime',
        'total_bayar' => 'decimal:2'
    ];

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute', 'id_rute');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Penumpang::class, 'id_pelanggan', 'id_penumpang');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'id_petugas');
    }
} 