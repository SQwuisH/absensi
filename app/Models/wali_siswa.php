<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wali_siswa extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'nik',
        'jenis_kelamin',
        'id',
        'alamat'
    ];

    public function ayah()
    {
        return $this->hasMany(siswa::class, 'nik_ayah', 'nik');
    }

    public function ibu()
    {
        return $this->hasMany(siswa::class, 'nik_ibu', 'nik');
    }

    public function wali()
    {
        return $this->hasMany(siswa::class, 'nik_wali', 'nik');
    }

    public function user()
    {
        return $this->hasOne(user::class, 'id', 'id_user');
    }
}
