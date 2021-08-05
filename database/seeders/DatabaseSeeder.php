<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            KategoriSeeder::class,
            StatusSeeder::class,
            JurusanSeeder::class,
            SkillSeeder::class
        ]);
    }
}
