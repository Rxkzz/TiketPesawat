<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeTransportasi extends Model
{
    use HasFactory;

    protected $table = 'type_transportasi';
    protected $primaryKey = 'id_type_transportasi';

    protected $fillable = [
        'nama_type',
        'keterangan'
    ];

    public function transportasi(): HasMany
    {
        return $this->hasMany(Transportasi::class, 'id_type_transportasi', 'id_type_transportasi');
    }
}
