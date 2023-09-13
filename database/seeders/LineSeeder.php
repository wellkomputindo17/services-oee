<?php

namespace Database\Seeders;

use App\Models\Line;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Line::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Line::insert([
            [
                'name' => 'Line 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Line 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Line 3',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}