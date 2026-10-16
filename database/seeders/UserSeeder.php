<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subsidiary;
use Illuminate\Support\Str;
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

        $subsidiaries = Subsidiary::get();

        foreach ($subsidiaries as $subsidiary) {
            User::create([
                'subsidiary_id' => $subsidiary->id,
                'name' => 'Admin ' . $subsidiary->subsidiary_name,
                'username' => 'admin' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name)),
                'password' => Hash::make('admin' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name))),
                'role' => 'Admin',
            ]);

            User::create([
                'subsidiary_id' => $subsidiary->id,
                'name' => 'Permintaan Barang ' . $subsidiary->subsidiary_name,
                'username' => 'permintaanbarang' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name)),
                'password' => Hash::make('permintaanbarang' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name))),
                'role' => 'Permintaan Barang',
            ]);

            User::create([
                'subsidiary_id' => $subsidiary->id,
                'name' => 'Time Planner HO ' . $subsidiary->subsidiary_name,
                'username' => 'timeplannerho' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name)),
                'password' => Hash::make('timeplannerho' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name))),
                'role' => 'Time Planner HO',
            ]);

            User::create([
                'subsidiary_id' => $subsidiary->id,
                'name' => 'Purchasing ' . $subsidiary->subsidiary_name,
                'username' => 'purchasing' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name)),
                'password' => Hash::make('purchasing' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name))),
                'role' => 'Purchasing',
            ]);

            User::create([
                'subsidiary_id' =>  $subsidiary->id,
                'name' => 'Gudang Pusat ' .  $subsidiary->subsidiary_name,
                'username' => 'gudangpusat' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name)),
                'password' => Hash::make('gudangpusat' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name))),
                'role' => 'Gudang Pusat',
            ]);

            User::create([
                'subsidiary_id' => $subsidiary->id,
                'name' => 'Gudang Central ' .  $subsidiary->subsidiary_name,
                'username' => 'gudangcentral' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name)),
                'password' => Hash::make('gudangcentral' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name))),
                'role' => 'Gudang Central',
            ]);

            User::create([
                'subsidiary_id' => $subsidiary->id,
                'name' => 'Gudang Site ' .  $subsidiary->subsidiary_name,
                'username' => 'gudangsite' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name)),
                'password' => Hash::make('gudangsite' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name))),
                'role' => 'Gudang Site',
            ]);

            User::create([
                'subsidiary_id' => $subsidiary->id,
                'name' => 'User ' .  $subsidiary->subsidiary_name,
                'username' => 'user' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name)),
                'password' => Hash::make('user' . Str::lower(Str::replace('-', '', $subsidiary->subsidiary_name))),
                'role' => 'User',
            ]);
        }
    }
}
