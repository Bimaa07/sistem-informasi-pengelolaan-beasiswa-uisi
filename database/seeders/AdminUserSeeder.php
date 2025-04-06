<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@uisi.ac.id',
            'password' => bcrypt('password123'),
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);
    }
}
