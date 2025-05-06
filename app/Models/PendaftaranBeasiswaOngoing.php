<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranBeasiswaOngoing extends Model
{
    protected $table = 'pendaftaran_beasiswa_ongoing';

    protected $fillable = [
        'mahasiswa_id',
        'beasiswa_id',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'tahun_ajaran',
        'content'
    ];

    protected $casts = [
        'status' => 'string',
        'tahun_ajaran' => 'string',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'aktif' => 'success',
            'nonaktif' => 'warning',
            'ditutup' => 'danger',
            default => 'secondary'
        };
    }
}
