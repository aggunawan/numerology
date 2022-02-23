<?php

namespace App\Policies;

use App\Models\Palace;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PalacePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAccess('palaces');
    }

    public function view(User $user, Palace $palace): bool
    {
        return $user->hasAccess('palaces');
    }

    public function create(User $user): bool
    {
        return $user->hasAccess('palaces');
    }

    public function update(User $user, Palace $palace): bool
    {
        return $user->hasAccess('palaces');
    }

    public function delete(User $user, Palace $palace): bool
    {
        return $user->hasAccess('palaces');
    }

    public function restore(User $user, Palace $palace): bool
    {
        return $user->hasAccess('palaces');
    }

    public function forceDelete(User $user, Palace $palace): bool
    {
        return $user->hasAccess('palaces');
    }
}
