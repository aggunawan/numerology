<?php

namespace App\View\Components;

use App\Models\PalaceDescription;
use Illuminate\View\Component;

class PalaceDescriptionTable extends Component
{
    public $palaceDescription;

    public $attributes = [
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

    public function __construct(PalaceDescription $palaceDescription)
    {
        $this->palaceDescription = $palaceDescription;
    }

    public function render()
    {
        return view('components.palace-description-table');
    }
}
