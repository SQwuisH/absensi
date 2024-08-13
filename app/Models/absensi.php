<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'id_koordinat_sekolah',
        'id_waktu_absen',
        'status',
        'bukti',
        'date',
        'jam_masuk',
        'jam_pulang',
        'titik_koordinat_masuk',
        'titik_koordinat_pulang',
    ];

    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'nis', 'nis');
    }

    public function koordinat()
    {
        return $this->belongsTo(koordinat_sekolah::class, 'id_koordinat_sekolah');
    }
}
