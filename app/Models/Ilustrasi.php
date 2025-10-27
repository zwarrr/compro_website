<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ilustrasi extends Model
{
    use HasFactory;

    protected $table = 'ilustrasis';
    protected $primaryKey = 'id_ilustrasi';

    protected $fillable = [
        'kode_ilustrasi',
        'judul',
        'deskripsi',
        'image',
        'status',
    ];

    public function pages()
    {
        return $this->hasMany(Page::class, 'ilustrasi_id', 'id_ilustrasi');
    }
}
