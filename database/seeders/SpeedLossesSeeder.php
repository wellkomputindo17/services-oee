<?php

namespace Database\Seeders;

use App\Models\SpeedLoss;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpeedLossesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SpeedLoss::insert([
            [
                'jenis_speedloss' => 'Idling and Minor Stoppages',
                'desc'      => null,
                'parent_id' => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_speedloss' => 'Reduce Speed',
                'desc'      => null,
                'parent_id' => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_speedloss' => 'Test Speedloss Parent 1',
                'desc'      => null,
                'parent_id' => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_speedloss' => 'Sensor atau limit switch terganggu',
                'desc'      => 'kejadian dimana sensor yang beroperasi tidak bekerja dikarenakan kendor sehingga harus di setting untuk itu operator menurunkan kecepatan mesin namun mesin tidak berhenti.',
                'parent_id' => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_speedloss' => 'Supplycompound terhambat',
                'desc'      => 'kejadian dimana compound yang masuk ke mesin extruder tidak lancar maka speed mesin harus diturunkan.',
                'parent_id' => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_speedloss' => 'Mengatur rem bobin',
                'desc'      => 'kejadian dimana rem atau brake untuk mengerem bobin tidak berfungsi sebagai mestinya.',
                'parent_id' => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_speedloss' => 'Mengatur overlap',
                'desc'      => 'kejadian dimana overlap produk yang dihasilkan tidak sesuai. Overlap disini adalah panjang dari awal gulungan dan akhir gulungan. Ketika kondisi ini, maka Operator harus memperlambat kecepatan mesin untuk mengaturnya.',
                'parent_id' => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_speedloss' => 'Kawat habis',
                'desc'      => 'kejadian dimana bahan baku kawat pada bobin sudah hampir habis (gulungan akhir).',
                'parent_id' => 2,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_speedloss' => 'Bead Former',
                'desc'      => 'kejadian dimana former yang digunakan oblak atau goyang sehingga supaya produk yang dihasilkan baik, maka operator mengatur kecepatan mesin pada posisi pelan atau lambat.',
                'parent_id' => 2,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

        ]);
    }
}
