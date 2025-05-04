<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaMahasiswa extends Model
{
    protected $table = 'penerima_mahasiswa';

    protected $fillable = [
        'user_id',
        'beasiswa_id',
        'status',
        'tanggal_submit',
        'valid_sampai',
    ];
    protected $casts = [
        'tanggal_submit' => 'date',
        'valid_sampai' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'user_id', 'user_id');
    }
}
