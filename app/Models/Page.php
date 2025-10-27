<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    
    protected $table = 'pages';
    protected $primaryKey = 'id_page';

    protected $fillable = [
        'ilustrasi_id',
        'kode_page',
        'digunakan_untuk',
        'judul',
        'sub_judul',
        'deskripsi',
        'button_primary_text',
        'button_primary_link',
        'button_secondary_text',
        'button_secondary_link',
        'status',
        'image',
    ];

    public function ilustrasi()
    {
        return $this->belongsTo(Ilustrasi::class, 'ilustrasi_id', 'id_ilustrasi');
    }
}
