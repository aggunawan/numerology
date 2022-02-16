<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $role = new Role();

        if (!$role->newQuery()->where('slug', 'super-admin')->exists()) {
            $superAdmin = new Role([
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'permissions' => [
                    "platform.index" => true,
                    "platform.systems.roles" => true,
                    "platform.systems.users" => true,
                    "platform.systems.attachment" => true,
                ],
            ]);
            $superAdmin->save();
        }

        if (!$role->newQuery()->where('slug', 'admin')->exists()) {
            $admin = new Role([
                'name' => 'Admin',
                'slug' => 'admin',
                'permissions' => [
                    "platform.index" => true,
                    "platform.systems.roles" => true,
                    "platform.systems.users" => true,
                    "platform.systems.attachment" => true,
                ],
            ]);
            $admin->save();
        }

        if (!$role->newQuery()->where('slug', 'client')->exists()) {
            $client = new Role([
                'name' => 'Client',
                'slug' => 'client',
                'permissions' => [
                    "platform.index" => false,
                    "platform.systems.roles" => false,
                    "platform.systems.users" => false,
                    "platform.systems.attachment" => false,
                ],
            ]);
            $client->save();
        }
    }
}
