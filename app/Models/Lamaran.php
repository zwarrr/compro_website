<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;
    protected $table = 'lamarans';
    protected $primaryKey = 'id_lamaran';

    protected $fillable = [
        'loker_id',
        'kode_lamaran',
        'nama_lengkap',
        'email',
        'resume',
        'pesan',
        'status',
        'catatan_hrd',
        'tanggal_interview',
    ];

    protected $casts = [
        'tanggal_interview' => 'datetime',
    ];

    /**
     * Get the Loker that this Lamaran belongs to.
     */
    public function loker()
    {
        return $this->belongsTo(Loker::class, 'loker_id', 'id_loker');
    }
}
