<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswa';

    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    // Mapping nama to deskripsi (judul beasiswa)
    public static $namaToTitle = [
        'bpel' => 'Beasiswa Pelengkap',
        'aktivis' => 'Beasiswa Aktivis',
        'bpa' => 'Beasiswa Prestasi Akademik'
    ];

    protected static function boot()
    {
        parent::boot();

        // Auto-fill deskripsi based on nama when creating
        static::creating(function ($beasiswa) {
            $beasiswa->deskripsi = self::$namaToTitle[$beasiswa->nama] ?? 'Unknown';
        });
    }

    public function getNamaBeasiswaLabel(): string
    {
        return $this->deskripsi;
    }
}
