<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'sosial_media';
    protected $primaryKey = 'id_sosial';

    protected $fillable = [
        'kode_sosial',
        'nama_sosmed',
        'username',
        'url',
        'icon',
        'warna',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
