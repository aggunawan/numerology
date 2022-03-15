<?php
namespace App\Orchid\Layouts\User;

use Orchid\Screen\Fields\DateRange;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),

            DateTimer::make('user.birth_date')
                ->title('Birth Date')
                ->format('Y-m-d'),

            DateRange::make('user.expiration_date')
                ->title('Expiration Date')
                ->value([
                    'start' => $this->query->get('user')->valid_date ?? null,
                    'end' => $this->query->get('user')->expired_date ?? null,
                ]),
        ];
    }
}
