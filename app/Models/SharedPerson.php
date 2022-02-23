<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $name
 * @property Carbon $birth_date
 */
class SharedPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
