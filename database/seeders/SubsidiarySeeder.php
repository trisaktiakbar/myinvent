<?php

namespace Database\Seeders;

use App\Models\Subsidiary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubsidiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subsidiary::create([
            'subsidiary_name' => 'IJS-PKS',
        ]);
        Subsidiary::create([
            'subsidiary_name' => 'MARO-PKS',
        ]);
        Subsidiary::create([
            'subsidiary_name' => 'HUK-PKS',
        ]);
        Subsidiary::create([
            'subsidiary_name' => 'IJS-KEBUN',
        ]);
        Subsidiary::create([
            'subsidiary_name' => 'HUK-KEBUN',
        ]);
    }
}
