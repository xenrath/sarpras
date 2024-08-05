<?php

namespace Database\Seeders;

use App\Models\Sopir;
use Illuminate\Database\Seeder;

class SopirSeeder extends Seeder
{
    public function run(): void
    {
        $supirs = [
            [
                'nama' => 'Heri Dwi Nanto',
                'telp' => '082313202906'
            ],
            [
                'nama' => 'Dakrowi',
                'telp' => '085842140195'
            ],
            [
                'nama' => 'Agus Prasojo',
                'telp' => '081229972733'
            ],
            [
                'nama' => 'Sugiarto',
                'telp' => '085293128051'
            ],
        ];

        Sopir::insert($supirs);
    }
}
