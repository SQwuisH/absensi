<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class waktu_absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'jam_masuk',
        'jam_pulang',
    ];

    public function waktu_absen()
    {
        return $this->hasMany(absensi::class, 'id_waktu_absen');
    }
}
