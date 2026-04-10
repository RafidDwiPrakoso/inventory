<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Kepala Staff Sarpras',
            'email' => 'headstaff@wikrama.sch.id',
            'role' => 'headstaff',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@gmail.com',
            'role' => 'staff',
            'password' => Hash::make('password123'),
        ]);
    }
}
