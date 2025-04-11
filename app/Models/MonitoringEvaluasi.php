<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringEvaluasi extends Model
{
    protected $table = 'monitoring_evaluasi';

    protected $fillable = [
        'periode_monitoring_evaluasi_id',
        'mahasiswa_id',
        'status',
        'tanggal_submit',
        'valid_sampai',
    ];
    protected $casts = [
        'tanggal_submit' => 'datetime',
        'valid_sampai' => 'datetime',
    ];

    public function periodeMonitoringEvaluasi()
    {
        return $this->belongsTo(PeriodeMonitoringEvaluasi::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    public function periodeMonitoring()
    {
        return $this->belongsTo(PeriodeMonitoring::class);
    }
}
