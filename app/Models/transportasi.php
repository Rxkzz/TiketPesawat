<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class transportasi extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'transportasi';

    // Menentukan primary key
    protected $primaryKey = 'id_transportasi';

    // Menentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'kode',
        'keterangan',
        'image',
        'id_type_transportasi',
    ];

    // Menentukan relasi dengan model TypeTransportasi
    public function typeTransportasi(): BelongsTo
    {
        return $this->belongsTo(TypeTransportasi::class, 'id_type_transportasi', 'id_type_transportasi');
    }
}
