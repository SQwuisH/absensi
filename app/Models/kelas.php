<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jurusan',
        'NUPTK',
        'nomor_kelas',
        'tingkat',
    ];

    public function jurusan()
    {
        return $this->hasOne(jurusan::class, 'id_jurusan');
    }

    public function wali()
    {
        return $this->belongsTo(wali::class, 'NUPTK');
    }
}
