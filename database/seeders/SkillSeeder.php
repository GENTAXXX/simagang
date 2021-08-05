<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skill = [
            'VueJS', 'JavaScript', 'PHP', 'Laravel', 'Bootstrap'
        ];
        foreach ($skill as $skil){
            Skill::create([
                'skill' => $skil
            ]);
        }
    }
}
