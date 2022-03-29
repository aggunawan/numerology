<?php

namespace App\Repositories;

use App\Models\User;

class BirthDateListRepository
{
    public function findActiveBirthDateList(User $user)
    {
        return $user->birthDayLists()->where('is_active', true)->first();
    }

    public function findInactiveBirthDateList(User $user)
    {
        return $user->birthDayLists()->where('is_active', false)->first();
    }
}
