<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoachingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coaching_categories')->insert([
            [
                'categories_coaching' => 'Private Coaching',
                'slug' => 'p_coach'
            ],
            [
                'categories_coaching' => 'Self Coaching',
                'slug' => 's_coach'
            ]
        ]);
    }
}
