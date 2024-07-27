<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wali extends Model
{
    use HasFactory;

    protected $fillable = [
        'nuptk',
        'id',
        'jenis_kelamin',
        'nip',
    ];

    public function user()
    {
        return $this->hasOne(user::class, 'id');
    }

    public function kelas()
    {
        return $this->hasOne(kelas::class, 'nuptk', 'nuptk');
    }

    public function jurusan()
    {
        return $this->hasOneThrough(jurusan::class, kelas::class, 'nuptk', 'id_jurusan', 'nuptk', 'id_jurusan');
    }
}


