<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Orchid\Platform\Models\Role;

class AssignClientRole
{
    public function __construct()
    {
        //
    }

    public function handle(Registered $event)
    {
        if ($event->user instanceof User) {
            $role = (new Role())->newQuery()->where('slug', 'client')->first();
            if ($role instanceof Role) $event->user->addRole($role);
        }
    }
}
