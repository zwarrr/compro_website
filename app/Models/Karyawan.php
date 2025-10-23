<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'kode_karyawan',
        'kategori_id',
        'nik',
        'nama',
        'staff',
        'foto',
        'deskripsi',
        'status',
        'posisi', // tambahkan posisi agar bisa diisi dan diupdate
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }
}
