<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Penumpang extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_penumpang';
    protected $guarded = ['id_penumpang'];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'password' => 'hashed',
    ];
} 