<?php

namespace Database\Seeders;

use App\Models\AgamaModel;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{

    /**
     * Mengisi tabel agama73 dengan data
     */

    public function run()
    {
        $agama = [
            ['id' => 1, 'nama_agama' => 'Islam'],
            ['id' => 2, 'nama_agama' => 'Kristen'],
            ['id' => 3, 'nama_agama' => 'Katolik'],
            ['id' => 4, 'nama_agama' => 'Hindu'],
            ['id' => 5, 'nama_agama' => 'Budha'],
            ['id' => 6, 'nama_agama' => 'Konghucu'],
        ];

        AgamaModel::insert($agama);
    }
}
