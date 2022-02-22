<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property array $content
 */
class BirthDateList extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
