<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DoModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DivisiSeeder::class,
            LevelAksesSeeder::class,
            LineSeeder::class,
            MesinSeeder::class,
            PlanDownTimeSeeder::class,
            UnplanDownTimeSeeder::class,
            SpeedLossesSeeder::class,
            QualityLossesSeeder::class
        ]);

        DoModel::insert([
            [
                'no_do' => '08230001',
                'name' => 'Testing DO 1',
                'target'    => 1832
            ],
            [
                'no_do' => '08230002',
                'name' => 'Testing DO 2',
                'target'    => 2637
            ],
            [
                'no_do' => '08230003',
                'name' => 'Testing DO 3',
                'target'    => 1392
            ],
        ]);

        User::insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            "divisi_id" => 1,
            "level_akses_id" => 1,
        ]);
    }
}
