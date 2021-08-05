<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'role' => 'Departemen',
            ],
            [
                'role' => 'Mitra',
            ],
            [
                'role' => 'Dosen Pembimbing',
            ],
            [
                'role' => 'Supervisor',
            ],
            [
                'role' => 'Mahasiswa',
            ],

        ];

        DB::table('role')->insert($role);
    }
}
