<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswa';
    protected $fillable = [
        'jenis',
        'nama',
    ];

    public function periodeMonitoring()
    {
        return $this->hasMany(PeriodeMonitoring::class);
    }
    public function penerimaBeasiswa()
    {
        return $this->hasMany(PenerimaBeasiswa::class);
    }
}
