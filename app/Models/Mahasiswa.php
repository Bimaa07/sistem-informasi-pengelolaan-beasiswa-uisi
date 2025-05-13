<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'program_studi',
        'mahasiswa_transfer',
        'email',
        'tahun_masuk'
    ];
    protected $casts = [
        'mahasiswa_transfer' => 'boolean',
        'tahun_masuk' => 'string',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getMahasiswaByNim($nim)
    {
        return $this->where('nim', $nim)->first();
    }
    public function getMahasiswaByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
