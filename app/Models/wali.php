<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wali extends Model
{
    use HasFactory;

    protected $fillable = [
        'nuptk',
        'id_user',
        'jenis_kelamin',
        'nip',
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


