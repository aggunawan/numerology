<?php

namespace App\Observers;

use App\Models\User;

class PersonObserver
{
    public function creating()
    {
        $user = auth()->user();

        if ($user instanceof User) {
            $roles = $user->getRoles()->pluck('slug');
            if ($roles->count() == 1 && $roles->first() == User::CLIENT) {
                if ($user->people()->count() == 3) abort(403);
            }
        }
    }
}
