<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PalaceDescriptionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAccess('palace_descriptions');
    }

    public function view(User $user): bool
    {
        return $user->hasAccess('palace_descriptions');
    }

    public function create(User $user): bool
    {
        return $user->hasAccess('palace_descriptions');
    }

    public function update(User $user): bool
    {
        return $user->hasAccess('palace_descriptions');
    }

    public function delete(User $user): bool
    {
        return $user->hasAccess('palace_descriptions');
    }

    public function restore(User $user): bool
    {
        return $user->hasAccess('palace_descriptions');
    }

    public function forceDelete(User $user): bool
    {
        return $user->hasAccess('palace_descriptions');
    }
}
