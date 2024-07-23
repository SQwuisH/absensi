<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_kelas',
        'nama',
        'jenis_kelamin',
        'NISN',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(absensi::class, 'NIS');
    }
}
