<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswa';
    protected $fillable = [
        'nama',
        'deskripsi',
        'status',
        'tahun_ajaran',
    ];
    protected $casts = [
        'status' => 'string',
        'tipe' => 'string',
        'tahun_ajaran' => 'string',
    ];

}
