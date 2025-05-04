<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaBeasiswa extends Model
{
    protected $table = 'penerima_beasiswa';

    protected $fillable = [
        'user_id',
        'beasiswa_id',
        'status',
        'tanggal_submit',
        'valid_sampai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
    public function monitoringEvaluasi()
    {
        return $this->hasMany(MonitoringEvaluasi::class);
    }
}
