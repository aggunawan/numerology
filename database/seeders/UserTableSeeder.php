<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'user',
                'email' => 'user@doxadigital.com',
                'password' => Hash::make('user1234'),
                'role_coaching' => 'user',
            ],
            [
                'name' => 'coach',
                'email' => 'coach@doxadigital.com',
                'password' => Hash::make('coach1234'),
                'role_coaching' => 'coach',
            ]
        ]);
    }
}
