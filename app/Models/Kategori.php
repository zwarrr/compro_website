<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'tipe',
    ];

    // Relasi ke model lain
    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'kategori_id', 'id_kategori');
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'kategori_id', 'id_kategori');
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'kategori_id', 'id_kategori');
    }

    public function client()
    {
        return $this->hasMany(Client::class, 'kategori_id', 'id_kategori');
    }
}
