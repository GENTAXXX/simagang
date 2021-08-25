<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@simagang.id',
            'role_id' => 1,
            'password' => bcrypt('adminsimagang'),
        ]);

        Departemen::create([
            'user_id' => $admin['id'],
            'nama_depart' => $admin['name'],
        ]);
    }
}
