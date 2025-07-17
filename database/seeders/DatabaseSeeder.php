<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama'     => 'Defril B',
            'username' => 'defril123',
            'email'    => 'admin@gmail.com',
            'jabatan'  => 'Admin',
            'password' => Hash::make('18120202'), // Hash password
            'is_tugas' => false,
        ]);

        User::create([
            'nama'     => 'Nurul',
            'username' => 'nurul123',
            'email'    => 'Nurul@gmail.com',
            'jabatan'  => 'Karyawan',
            'password' => Hash::make('18120202'), // Hash password
            'is_tugas' => false,
        ]);

        User::create([
            'nama'     => 'Azis',
            'username' => 'azis123',
            'email'    => 'Azis@gmail.com',
            'jabatan'  => 'Pimpinan',
            'password' => Hash::make('18120202'), // Hash password
            'is_tugas' => false,
        ]);

        User::create([
            'nama'     => 'Andi',
            'username' => 'andi123',
            'email'    => 'Andi@gmail.com',
            'jabatan'  => 'Karyawan',
            'password' => Hash::make('18120202'), // Hash password
            'is_tugas' => false,
        ]);
    }
}
 
