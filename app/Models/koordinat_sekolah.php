<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class koordinat_sekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'titik_koordinat',
        'jarak',
    ];

    public function koordinat()
    {
        return $this->hasMany(absensi::class, 'id_koordinat_sekolah');
    }
}
