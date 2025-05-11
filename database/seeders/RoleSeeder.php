<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'student',
                'name_idn' => 'Mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin',
                'name_idn' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'head_of_study_program',
                'name_idn' => 'Kepala Program Studi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Role::insert($roles);
    }
}
