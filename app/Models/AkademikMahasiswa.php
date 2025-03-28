<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkademikMahasiswa extends Model
{
    protected $guarded = ['id'];
    protected $table = 'akademik_mahasiswa';

    public function formMonev()
    {
        return $this->belongsTo(FormLaporanMonitoringDanEvaluasi::class, 'form_monev_id');
    }
}
