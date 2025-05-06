<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeMonitoring extends Model
{
    protected $table = 'periode_monitoring_evaluasi_beasiswa_full';

    protected $fillable = [
        'tahun_ajaran',
        'semester_akademik',
        'tanggal_mulai',
        'status',
    ];

    public function getStatusAttribute($value)
    {
        return $value === 'dibuka' ? 'Dibuka' : 'Ditutup';
    }
    public function getSemesterAkademikAttribute($value)
    {
        return $value === 'ganjil' ? 'Ganjil' : 'Genap';
    }

    public function getRawSemesterAkademikAttribute()
    {
        return $this->attributes['semester_akademik'];
    }
}
