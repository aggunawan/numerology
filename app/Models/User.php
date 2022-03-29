<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Platform\Models\User as Authenticatable;

/**
 * @property string $name
 * @property string $birth_date
 * @property Carbon $valid_date
 * @property Carbon $expired_date
 */
class User extends Authenticatable
{
    public const SUPER_ADMIN = 'super-admin';
    public const ADMIN = 'admin';
    public const CLIENT = 'client';
    public const PRACTITIONER = 'practitioner';
    public const TRAINER = 'trainer';

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
}
