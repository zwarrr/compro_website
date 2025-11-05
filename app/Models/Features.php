<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    use HasFactory;

    protected $table = 'features';
    protected $primaryKey = 'id_features';

    protected $fillable = [
        'kode_features',
        'judul',
        'sub_judul',
        'status',
        'replace_position',
    ];

    protected $casts = [
        'replace_position' => 'integer',
    ];
}
