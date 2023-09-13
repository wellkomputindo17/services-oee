<?php

namespace Database\Seeders;

use App\Models\Mesin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MesinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mesin::insert([
            [
                'no_mesin' => 'MS-001',
                'name'     => 'MACHINE 1',
                'year'     => 2010
            ],
            [
                'no_mesin' => 'MS-002',
                'name'     => 'MACHINE 2',
                'year'     => 2015
            ],
            [
                'no_mesin' => 'MS-003',
                'name'     => 'MACHINE 3',
                'year'     => 2020
            ],
        ]);
    }
}