<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hariLibur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hari_libur',
        'tanggal_libur',
        'keterangan_libur',
    ];
}
