<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoachingNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coaching_numbers')->insert([
            [
                'coaching_number' => 1
            ],
            [
                'coaching_number' => 3
            ],
            [
                'coaching_number' => 5
            ],
            [
                'coaching_number' => 7
            ],
            [
                'coaching_number' => 9
            ]
        ]);
    }
}
