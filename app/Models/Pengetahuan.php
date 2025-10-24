<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengetahuan extends Model
{
    use HasFactory;

    protected $table = 'pengetahuans';
    protected $primaryKey = 'id_pengetahuan';

    protected $fillable = [
        'kode_pengetahuan',
        'kategori_pertanyaan',
        'sub_kategori',
        'jawaban',
    ];
}
