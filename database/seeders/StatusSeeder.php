<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'status' => 'Belum Magang',
            ],
            [
                'status' => 'Sedang Magang',
            ],
            [
                'status' => 'Sudah Magang',
            ],
            [
                'status' => 'Sedang Mengajukan',
            ],
        ];

        DB::table('status')->insert($status);
    }
}
