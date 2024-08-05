<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $kendaraans = [
            [
                'nama' => 'Sepeda Motor HONDA REVO',
                'kapasitas' => '2'
            ],
            [
                'nama' => 'Toyota Avanza',
                'kapasitas' => '6'
            ],
            [
                'nama' => 'Bus',
                'kapasitas' => '20'
            ],
            [
                'nama' => 'Toyota Inova Diesel',
                'kapasitas' => '6'
            ],
            [
                'nama' => 'Toyota Haice',
                'kapasitas' => '6'
            ],
            [
                'nama' => 'Suzuki pic-up',
                'kapasitas' => '2'
            ],
            [
                'nama' => 'Toyota Inova Metic Bensin',
                'kapasitas' => '6'
            ],
            [
                'nama' => 'Toyota HRV',
                'kapasitas' => '8'
            ],
            [
                'nama' => 'Toyota Hilux',
                'kapasitas' => '8'
            ],
        ];

        Kendaraan::insert($kendaraans);
    }
}
