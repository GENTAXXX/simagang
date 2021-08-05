<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = [
            [
                'jurusan' => 'D4 Teknologi Rekayasa Perangkat Lunak (TRPL)',
            ],
            [
                'jurusan' => 'D4 Teknologi Rekayasa Internet (TRI)',
            ],
            [
                'jurusan' => 'D4 Teknologi Rekayasa Instrumentasi dan Kontrol (TRIK)',
            ],
            [
                'jurusan' => 'D4 Teknologi Rekayasa Elektro (TRE)',
            ],

        ];

        DB::table('jurusan')->insert($jurusan);
    }
}
