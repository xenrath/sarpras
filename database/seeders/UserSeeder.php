<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Saiful Labib Marzuqi Hidayat, S.Tr.Kom',
                'telp' => '085328481969',
                'password' => bcrypt('bhamada'),
                'password_text' => 'bhamada',
                'nipy' => null,
                'role' => 'dev'
            ],
            [
                'nama' => 'Dwipa Ari Putra, A.Md',
                'telp' => '08159610197',
                'password' => bcrypt('bhamada'),
                'password_text' => 'bhamada',
                'nipy' => '1982.03.10.21.149',
                'role' => 'sarpras'
            ],
            [
                'nama' => 'Sidiq Pranoto, SE',
                'telp' => '081326971699',
                'password' => bcrypt('bhamada'),
                'password_text' => 'bhamada',
                'nipy' => '1973.10.03.00.016',
                'role' => 'bauk'
            ],
            [
                'nama' => 'Much. Achadi',
                'telp' => '082324709753',
                'password' => bcrypt('bhamada'),
                'password_text' => 'bhamada',
                'nipy' => null,
                'role' => 'sarana'
            ],
            [
                'nama' => 'Heri Purwoso',
                'telp' => '081286493375',
                'password' => bcrypt('bhamada'),
                'password_text' => 'bhamada',
                'nipy' => null,
                'role' => 'prasarana'
            ],
        ];

        User::insert($users);
    }
}
