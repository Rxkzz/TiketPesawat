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
        'id_rute',
        'id_petugas',
        'kode_kursi',
        'tujuan',
        'tanggal_berangkat',
        'jam_cekin',
        'jam_berangkat',
        'total_bayar',
        'jumlah_penumpang',
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

    protected static function boot()
    {
        parent::boot();

        // Saat pemesanan dibuat
        static::creating(function ($pemesanan) {
            $rute = Rute::find($pemesanan->id_rute);
            if ($rute) {
                // Hitung total bayar berdasarkan jumlah penumpang dan tambahkan pajak 10%
                $harga_dasar = $rute->hitungTotalHarga($pemesanan->jumlah_penumpang);
                $pajak = $harga_dasar * 0.1; // 10% pajak
                $pemesanan->total_bayar = $harga_dasar + $pajak;
                
                // Kurangi kursi tersedia
                if (!$rute->kurangiKursi($pemesanan->jumlah_penumpang)) {
                    throw new \Exception('Kursi tidak tersedia');
                }
            }
        });

        // Saat pemesanan dibatalkan atau dihapus
        static::deleting(function ($pemesanan) {
            $rute = Rute::find($pemesanan->id_rute);
            if ($rute && $pemesanan->status_pembayaran !== 'PAID') {
                $rute->tambahKursi($pemesanan->jumlah_penumpang);
            }
        });
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Penumpang::class, 'id_pelanggan', 'id_penumpang');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }
} 