<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'prodi',
        'penerima_beasiswa_full',
    ];
    protected $casts = [
        'penerima_beasiswa_full' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasFullScholarship()
    {
        return $this->penerima_beasiswa_full === true;
    }


}
