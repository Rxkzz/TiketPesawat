<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rute extends Model
{
    use HasFactory;

    protected $table = 'rute';

    protected $primaryKey = 'id_rute';

    protected $fillable = [
        'tujuan',
        'rute_awal',
        'rute_akhir',
        'harga',
        'id_transportasi',
        'tanggal_berangkat',
        'waktu_keberangkatan',
    ];

    public function transportasi()
    {
        return $this->belongsTo(transportasi::class, 'id_transportasi', 'id_transportasi');
    }
}
