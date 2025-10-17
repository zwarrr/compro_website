<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePerusahaan extends Model
{
    use HasFactory;

    protected $table = 'profile_perusahaan';
    protected $primaryKey = 'id_perusahaan';

    protected $fillable = [
        'kode_profile',
        'nama_perusahaan',
        'slogan',
        'deskripsi',
        'visi',
        'misi',
        'alamat',
        'telepon',
        'email',
    ];
}
