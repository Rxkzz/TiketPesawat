<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

     protected $table = 'users';  
     protected $primaryKey = 'id_petugas';
     public $timestamps = true;

    protected $fillable = [

        'name',
        'email',
        'password',

     ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function petugas()
    {
          return $this->belongsTo(Petugas::class, 'id_petugas');
    }
  }