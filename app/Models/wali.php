<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wali extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'nuptk',
        'id_user',
        'jenis_kelamin',
        'nip',
    ];

    public function user()
    {
        return $this->hasOne(user::class, 'id', 'id_user');
    }

    public function kelas()
    {
        return $this->hasOne(kelas::class, 'nip', 'nip');
    }

    public function jurusan()
    {
        return $this->hasOneThrough(jurusan::class, kelas::class, 'nip', 'id_jurusan', 'nip', 'id_jurusan');
    }
}


