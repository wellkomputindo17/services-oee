<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Divisi::insert([
            [
                'name'      => 'Quality',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'      => 'Production',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'      => 'Maintenance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'      => 'Guest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'      => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
