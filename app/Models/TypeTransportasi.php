<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeTransportasi extends Model
{
    use HasFactory;

    protected $table = 'type_transportasi';
    protected $primaryKey = 'id_type_transportasi';

    protected $fillable = [
        'id_type_transportasi',
        'nama_type',
        'keterangan'
    ];
}
