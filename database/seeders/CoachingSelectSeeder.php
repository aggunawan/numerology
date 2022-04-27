<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoachingSelectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coaching_selects')->insert([
            [
                'coaching_select' => 'P1ntu'
            ],
            [
                'coaching_select' => 'Inspirasi'
            ],
            [
                'coaching_select' => 'Oracle'
            ]
        ]);
    }
}
