<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestasiMahasiswa extends Model
{
    protected $guarded = ['id'];

    public function formMonev()
    {
        return $this->belongsTo(FormLaporanMonitoringDanEvaluasi::class, 'form_monev_id');
    }
}
