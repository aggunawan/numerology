<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 */
class Palace extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $fillable = [
        'code',
        'name',
        'description',
        'font_color',
        'background_color',
    ];
}
