<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaBeasiswa extends Model
{
    protected $table = 'penerima_beasiswa';
    protected $fillable = [
        'mahasiswa_id',
        'beasiswa_id',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }

    public function periodeMonitoring()
    {
        return $this->belongsTo(PeriodeMonitoring::class);
    }
    public function monitoringEvaluasi()
    {
        return $this->hasMany(MonitoringEvaluasi::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }
    public function scopeInactive($query)
    {
        return $query->where('status', 'nonaktif');
    }
}
