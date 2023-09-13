<?php

namespace Database\Seeders;

use App\Models\LevelAkses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LevelAkses::insert([
            [
                'name'      => 'Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'      => 'SPV/Leader',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'      => 'Operator/Forman',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
