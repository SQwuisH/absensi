<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    public $primaryKey  = 'nis';
    protected $fillable = [
        'nis',
        'id',
        'id_kelas',
        'nama',
        'jenis_kelamin',
        'NISN',
    ];

    public function user()
    {
        return $this->hasOne(user::class, 'id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(absensi::class, 'NIS');
    }


    public function jurusan()
    {
        return $this->hasOneThrough(jurusan::class, kelas::class, 'id_kelas', 'id_jurusan', 'id_kelas', 'id_jurusan');
    }
}
