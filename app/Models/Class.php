<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';
    protected $primaryKey = 'id_class';
    
    protected $fillable = [
        'nama_class',
        'harga_tambahan',
        'keterangan'
    ];

    public function fasilitas(): BelongsToMany
    {
        return $this->belongsToMany(Fasilitas::class, 'class_fasilitas', 'id_class', 'id_fasilitas')
                    ->withTimestamps();
    }
} 