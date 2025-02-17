<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rute extends Model
{
    use HasFactory;

    protected $table = 'rute';

    protected $primaryKey = 'id_rute';

    protected $fillable = [
        'tujuan',
        'rute_awal',
        'rute_akhir',
        'harga',
        'total_harga',
        'id_transportasi',
        'tanggal_berangkat',
        'waktu_berangkat',
        'waktu_tiba',
        'id_class',
        'gambar',
        'jumlah_kursi',
        'kursi_tersedia'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($rute) {
            // Set kursi_tersedia sama dengan jumlah_kursi saat pertama kali dibuat
            if (!$rute->kursi_tersedia) {
                $rute->kursi_tersedia = $rute->jumlah_kursi;
            }
        });

        static::saving(function ($rute) {
            if ($rute->id_class) {
                $class = ClassModel::find($rute->id_class);
                if ($class) {
                    $rute->total_harga = $rute->harga + $class->harga_tambahan;
                }
            } else {
                $rute->total_harga = $rute->harga;
            }
        });
    }

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class, 'id_transportasi');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'id_class', 'id_class');
    }

    public function fasilitas(): BelongsTo
    {
        return $this->belongsTo(Fasilitas::class, 'id_fasilitas', 'id_fasilitas');
    }

    public function getTotalHargaAttribute($value)
    {
        if (!$value || $value == 0) {
            return $this->harga + ($this->class ? $this->class->harga_tambahan : 0);
        }
        return $value;
    }

    public function kurangiKursi($jumlah)
    {
        if ($this->kursi_tersedia >= $jumlah) {
            $this->kursi_tersedia -= $jumlah;
            $this->save();
            return true;
        }
        return false;
    }

    public function tambahKursi($jumlah)
    {
        if (($this->kursi_tersedia + $jumlah) <= $this->jumlah_kursi) {
            $this->kursi_tersedia += $jumlah;
            $this->save();
            return true;
        }
        return false;
    }

    public function hitungTotalHarga($jumlahPenumpang)
    {
        // Hitung harga dasar (tanpa pajak)
        $hargaDasar = $this->total_harga ?: $this->getTotalHargaAttribute(null);
        return $hargaDasar * $jumlahPenumpang;
    }

    public function cekKetersediaanKursi($jumlahPenumpang)
    {
        return $this->kursi_tersedia >= $jumlahPenumpang;
    }
}
