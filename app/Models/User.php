<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Orchid\Platform\Models\User as Authenticatable;

/**
 * @property int    $id
 * @property string $name
 * @property string $birth_date
 * @property Carbon $valid_date
 * @property Carbon $expired_date
 * @property Credit $credit
 */
class User extends Authenticatable
{
    public const SUPER_ADMIN = 'super-admin';
    public const ADMIN = 'admin';
    public const CLIENT = 'client';
    public const PRACTITIONER = 'practitioner';
    public const TRAINER = 'trainer';

    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
        'birth_date',
        'valid_date',
        'expired_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
        'valid_date'           => 'date',
        'expired_date'         => 'date',
    ];

    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function birthDayLists(): HasMany
    {
        return $this->hasMany(BirthDateList::class);
    }

    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function credit(): HasOne
    {
        return $this->hasOne(Credit::class)->withDefault(new Credit(['point' => 0, 'user_id' => $this->id]));
    }

    public function userrole(){
        return $this->hasMany(RolesUser::class, 'user_id', 'id');
    }
}
