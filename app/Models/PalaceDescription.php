<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class PalaceDescription extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $fillable = [
        'day_master',
        'culture',
        'education',
        'mindset',
        'belief',
        'career',
        'partner',
        'ambition',
        'talent',
        'business',
        'intellectual',
        'spiritual',
        'emotional',
        'social',
        'relationship',
        'financial',
        'son',
        'daughter',
        'character',
        'health',
        'physical',
        'goal',
    ];

    protected $casts = [
        'day_master' => 'array',
        'culture' => 'array',
        'education' => 'array',
        'mindset' => 'array',
        'belief' => 'array',
        'career' => 'array',
        'partner' => 'array',
        'ambition' => 'array',
        'talent' => 'array',
        'business' => 'array',
        'intellectual' => 'array',
        'spiritual' => 'array',
        'emotional' => 'array',
        'social' => 'array',
        'relationship' => 'array',
        'financial' => 'array',
        'son' => 'array',
        'daughter' => 'array',
        'character' => 'array',
        'health' => 'array',
        'physical' => 'array',
        'goal' => 'array',
    ];

    public function palace(): BelongsTo
    {
        return $this->belongsTo(Palace::class);
    }
}
