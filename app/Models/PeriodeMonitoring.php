<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeMonitoring extends Model
{
    protected $table = 'periode_monitoring';
    protected $fillable = [
        'beasiswa_id',
        'tahun_ajaran',
        'semester',
        'tahun',
        'status',
    ];

    public function penerimaBeasiswa()
    {
        return $this->hasMany(PenerimaBeasiswa::class);
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

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }

    // Get start year from tahun_ajaran
    public function getTahunAwalAttribute()
    {
        return (int) substr($this->tahun_ajaran, 0, 4);
    }

    // Get end year from tahun_ajaran
    public function getTahunAkhirAttribute()
    {
        return (int) substr($this->tahun_ajaran, 5, 4);
    }
}
