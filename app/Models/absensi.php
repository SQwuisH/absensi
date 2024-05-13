<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'NIS',
        'id_koordinat_sekolah',
        'id_waktu_absen',
        'status',
        'bukti',
        'date',
        'jam_masuk',
        'jam_pulang',
        'titik_koordinat',
    ];

    public function absensi()
    {
        return $this->belongsTo(siswa::class, 'id_siswa');
    }

    public function koordinat()
    {
        return $this->belongsTo(koordinat_sekolah::class, 'id_koordinat_sekolah');
    }
}
