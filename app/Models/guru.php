<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nama',
        'jenis_kelamin',
        'NIP',
        'NIK',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'id');
    }

    public function kelas()
    {
        return $this->hasOne(kelas::class, 'NUPTK');
    }
}


