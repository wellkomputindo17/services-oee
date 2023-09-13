<?php

namespace Database\Seeders;

use App\Models\UnplanDownTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnplanDownTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnplanDownTime::insert([
            [
                'jenis_downtime' => 'Equipment Failure loses',
                'desc'      => null,
                'parent_id' => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Set up and adjustment losses',
                'desc'      => null,
                'parent_id' => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Testing Unplan Times',
                'desc'      => null,
                'parent_id' => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Kegagalan Dies/Inserter',
                'parent_id' => 1,
                'desc'          => 'kejadian yang terjadi pada saatpemasangan die atau inserter tidak pas kedudukannya sehingga menyebabkan scrap, sehingga  operator harus menghentikan produksi untuk memperbaikinya.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Instrument/Elektrik Rusak (EJO)',
                'parent_id' => 1,
                'desc'          => 'kejadian dimana mesin rusak yang disebabkan oleh komponen elektrik, seperti PLC harus diganti sehingga mesin harus berhenti.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Kerusakan Mekanik (EJO)',
                'parent_id' => 1,
                'desc'          => 'kejadian dimana mesin rusak yang disebabkan oleh komponen mekanik, seperti gear aus atau piston bocor sehingga mesin harus berhenti.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Perbaikan Internal',
                'parent_id' => 1,
                'desc'          => 'perbaikan yang dilakukan operator apabila ada keabnormalan pada cutter untuk memotong. Kondisi mesin ketika operator memperbaiki harus berhenti.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Former Rusak',
                'parent_id' => 1,
                'desc'          => 'kejadian dimana bead former yang digunakan rusak, seperti piston bocor, pegas kick out patah dan harus diganti sparepart sehingga menyebabkan mesin berhenti.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Dies Aus',
                'parent_id' => 1,
                'desc'          => 'kejadian dimana dies yang digunakan sudah aus karena penggunaan sehingga harus diganti dengan yang baru.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Persiapan bahan bakucompound',
                'parent_id' => 2,
                'desc'          => 'mengambil material compound. Proses pengambilan di awali dengan menyiapkan loricompound kemudian compound di- slitting atau dipotong strip-strip seperti mie.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Persiapan bahan baku kawat',
                'parent_id' => 2,
                'desc'          => 'mengambil material kawat dari area storage bahan baku kawat ke area let off.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Persiapan tooling bead former, dies dan inserter',
                'parent_id' => 2,
                'desc'          => 'menyiapkan bead former, dies dan inserter sesuai dengan size yang ingin diproduksi. Persiapan ini tidak harus berbarengan namun menyeseuaikan dengan schedule produksi yang ingin diproduksi.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Compound atau kawat shortage',
                'parent_id' => 2,
                'desc'          => 'kejadian dimana stockcompound atau kawat yang digunakan untuk proses produksi minim atau tidak ada sehingga produksi berhenti.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'Kawat Problem',
                'parent_id' => 2,
                'desc'          => 'kejadian seperti kawat putus dari let off, kawat kusut di area let off sehingga operator dan mesin harus berhenti.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'jenis_downtime' => 'As atau shaft bobin patah',
                'parent_id' => 2,
                'desc'          => 'kejadian dimana shaft untuk bobin patah ketika proses produksi, sehingga operator harus mengganti dan mesin berhenti.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],

        ]);
    }
}
