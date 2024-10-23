<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    use HasFactory;

    public $primaryKey  = 'id_jurusan';
    public $incrementing = false;
    public $timestamps = false;
    protected $keytype = 'string';

    protected $fillable = [
        'id_jurusan',
        'nama_jurusan',
    ];

    public function jurusan()
    {
        return $this->hasMany(kelas::class,'id_jurusan', 'id_jurusan');
    }

    public function walijurusan()
    {
        return $this->hasOneThrough(wali::class, kelas::class, 'id_jurusan', 'nip', 'id_jurusan', 'nip');
    }

    public function siswajurusan()
    {
        return $this->hasOneThrough(siswa::class, kelas::class, 'id_jurusan', 'id_kelas', 'id_jurusan', 'id_kelas');
    }
}
