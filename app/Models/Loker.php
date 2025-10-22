<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_loker';
    protected $table = 'lokers';

    protected $fillable = [
        'kode_loker',
        'posisi',
        'perusahaan',
        'lokasi',
        'deskripsi',
        'gaji_awal',
        'gaji_akhir',
        'pengalaman',
        'pendidikan',
        'status',
    ];

    /**
     * Get all lamaran for this loker.
     */
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'loker_id', 'id_loker');
    }

    /**
     * Count applicants for this loker.
     */
    public function applicantsCount()
    {
        return $this->lamaran()->count();
    }
}
