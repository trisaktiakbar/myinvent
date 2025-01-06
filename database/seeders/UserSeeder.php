<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Gudang Pusat',
            'username' => 'gudangpusat',
            'password' => Hash::make('gudangpusat123'),
            'role' => 'Gudang Pusat',
        ]);

        User::create([
            'name' => 'Gudang Central',
            'username' => 'gudangcentral',
            'password' => Hash::make('gudangcentral123'),
            'role' => 'Gudang Central',
        ]);

        User::create([
            'name' => 'Gudang Site',
            'username' => 'gudangsite',
            'password' => Hash::make('gudangsite123'),
            'role' => 'Gudang Site',
        ]);
    }
}
