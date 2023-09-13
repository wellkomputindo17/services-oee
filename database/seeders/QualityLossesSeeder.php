<?php

namespace Database\Seeders;

use App\Models\QualityLoss;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QualityLossesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QualityLoss::insert([
            [
                'jenis_qualityloss' => 'Start-up Reject',
                'desc'              => 'Merupakan losses yang terjadi ketika produk reject pada awal set-up mesin. Lossesini dibagi menjadi dua kategori yaitu scrap dan repair. Scrap yaitu produk yang dihasilkan reject dan tidak bisa diperbaiki seperti bead botak (kawat tidak terlapis compound), panjang overlap tidak sesuai spesifikasi, danBIC (Bead Inner Circle) tidak sesuai spesifikasi. Sedangkan repair yaitu produk yang dihasilkan masih dalam kondisi dapat di perbaiki seperti susunan miring atau tidak rata.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_qualityloss' => 'Production Reject',
                'desc'              => 'Merupakan losses yang terjadi ketika produk rejectpada mesin sudah berjalan mass production. Losses yang termasuk kategori ini yaitu: scrap, repair.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ]);
    }
}
