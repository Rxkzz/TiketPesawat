<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';
    protected $primaryKey = 'id_class';
    
    protected $fillable = [
        'nama_class',
        'harga_tambahan',
        'bagasi',
        'hiburan',
        'keterangan'
    ];

    public function fasilitas(): BelongsToMany
    {
        return $this->belongsToMany(Fasilitas::class, 'class_fasilitas', 'id_class', 'id_fasilitas')
                    ->withTimestamps();
    }

    public function rute(): HasMany
    {
        return $this->hasMany(Rute::class, 'id_class', 'id_class');
    }
} 