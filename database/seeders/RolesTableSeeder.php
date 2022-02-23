<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $role = new Role();

        if (!$role->newQuery()->where('slug', User::SUPER_ADMIN)->exists()) {
            $superAdmin = new Role([
                'name' => 'Super Admin',
                'slug' => User::SUPER_ADMIN,
                'permissions' => [
                    "platform.index" => true,
                    "platform.systems.roles" => true,
                    "platform.systems.users" => true,
                    "platform.systems.attachment" => true,
                ],
            ]);
            $superAdmin->save();
        }

        if (!$role->newQuery()->where('slug', User::ADMIN)->exists()) {
            $admin = new Role([
                'name' => 'Admin',
                'slug' => User::ADMIN,
                'permissions' => [
                    "platform.index" => true,
                    "platform.systems.roles" => true,
                    "platform.systems.users" => true,
                    "platform.systems.attachment" => true,
                ],
            ]);
            $admin->save();
        }

        if (!$role->newQuery()->where('slug', User::CLIENT)->exists()) {
            $client = new Role([
                'name' => 'Client',
                'slug' => User::CLIENT,
                'permissions' => [
                    "platform.index" => false,
                    "platform.systems.roles" => false,
                    "platform.systems.users" => false,
                    "platform.systems.attachment" => false,
                ],
            ]);
            $client->save();
        }

        if (!$role->newQuery()->where('slug', User::PRACTITIONER)->exists()) {
            $client = new Role([
                'name' => 'Practitioner',
                'slug' => User::PRACTITIONER,
                'permissions' => [
                    "platform.index" => true,
                    "platform.systems.roles" => false,
                    "platform.systems.users" => false,
                    "platform.systems.attachment" => false,
                ],
            ]);
            $client->save();
        }

        if (!$role->newQuery()->where('slug', User::TRAINER)->exists()) {
            $client = new Role([
                'name' => 'Trainer',
                'slug' => User::TRAINER,
                'permissions' => [
                    "platform.index" => true,
                    "platform.systems.roles" => false,
                    "platform.systems.users" => false,
                    "platform.systems.attachment" => false,
                ],
            ]);
            $client->save();
        }
    }
}
