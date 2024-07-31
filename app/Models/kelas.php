<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;

    public $primaryKey  = 'id_kelas';
    public $timestamps = false;
    protected $fillable = [
        'id_kelas',
        'id_jurusan',
        'nuptk',
        'nomor_kelas',
        'tingkat',
    ];

    public function jurusan()
    {
        return $this->hasOne(jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function wali()
    {
        return $this->hasOne(wali::class, 'nuptk', 'nuptk');
    }

    public function user()
    {
        return $this->hasOneThrough(user::class, wali::class, 'nuptk', 'id', 'nuptk', 'id');
    }
}
