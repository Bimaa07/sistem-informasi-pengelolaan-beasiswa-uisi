<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianMonitoring extends Model
{
    protected $table = 'penilaian_monitoring';
    protected $fillable = [
        'penerima_beasiswa_id',
        'periode_monitoring_id',
        'tanggal',
        'evaluasi',
        'status',
    ];

    public function penerimaBeasiswa()
    {
        return $this->belongsTo(PenerimaBeasiswa::class);
    }

    public function periodeMonitoring()
    {
        return $this->belongsTo(PeriodeMonitoring::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'nonaktif');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'selesai');
    }
}
