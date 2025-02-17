<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';
    
    protected $fillable = [
        'nama_fasilitas',
        'deskripsi',
        'icon'
    ];

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(ClassModel::class, 'class_fasilitas', 'id_fasilitas', 'id_class')
                    ->withTimestamps();
    }
} 