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
    ];

    public function siswa()
    {
        return $this->hasMany(siswa::class, 'nik');
    }

    public function user()
    {
        return $this->hasOne(user::class, 'id', 'id_user');
    }
}
