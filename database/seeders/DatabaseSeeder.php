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
        $this->call(UserTableSeeder::class);
        // $this->call(RolesP1ntuSeeder::class);
        // $this->call(AssignRolesP1ntuSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CoachingCategorySeeder::class);
        $this->call(CoachingNumberSeeder::class);
        $this->call(CoachingSelectSeeder::class);
    }
}
