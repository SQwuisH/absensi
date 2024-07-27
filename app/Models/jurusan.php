<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jurusan',
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class ,'id_jurusan');
    }

    public function jurusan()
    {
        return $this->hasOneThrough(wali::class, kelas::class, 'id_jurusan', 'nutpk', 'id_jurusan', 'nutpk');
    }
}
