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
    protected $guarded = [];

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'class_fasilitas', 'id_class', 'id_fasilitas');
    }

    public function rute()
    {
        return $this->hasMany(Rute::class, 'id_class');
    }
} 