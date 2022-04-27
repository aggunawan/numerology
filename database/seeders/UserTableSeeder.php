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
                'name' => 'root',
                'email' => 'root@doxadigital.com',
                'password' => Hash::make('admin1234')
            ],
            [
                'name' => 'superuser',
                'email' => 'superuser@doxadigital.com',
                'password' => Hash::make('super1234')
            ]
        ]);
    }
}
