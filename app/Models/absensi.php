<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'status',
        'foto_masuk',
        'foto_pulang',
        'date',
        'jam_masuk',
        'jam_pulang',
        'titik_koordinat_masuk',
        'titik_koordinat_pulang',
    ];

    public $timestamps = false;

    public function absensi()
    {
        return $this->belongsTo(siswa::class, 'nis', 'nis');
    }

    public function koordinat()
    {
        return $this->belongsTo(koordinat_sekolah::class, 'id_koordinat_sekolah');
    }
}
