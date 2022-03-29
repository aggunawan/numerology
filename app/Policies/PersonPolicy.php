<?php

namespace App\Policies;

use App\Observers\PersonObserver;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(): bool
    {
        return true;
    }

    public function create(): bool
    {
        try {
            (new PersonObserver())->creating();
            return true;
        } catch (Exception $ex) { }
        return false;
    }

    public function update(): bool
    {
        return true;
    }

    public function delete(): bool
    {
        return true;
    }

    public function restore(): bool
    {
        return true;
    }

    public function forceDelete(): bool
    {
        return true;
    }
}
