<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'status',
        'terakhir_aktif',
    ];

    protected $hidden = ['password'];
    
    protected $casts = [
        'terakhir_aktif' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
