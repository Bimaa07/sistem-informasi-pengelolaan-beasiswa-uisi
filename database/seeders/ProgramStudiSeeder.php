<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        $programStudi = [
            [
                'nama' => 'Teknik Kimia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Manajemen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Manajemen Rekayasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Akuntansi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sistem Informasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Teknik Logistik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Desain Komunikasi Visual',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ekonomi Syariah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Teknologi Industri Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Teknologi Industri Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        ProgramStudi::insert($programStudi);
    }
}
