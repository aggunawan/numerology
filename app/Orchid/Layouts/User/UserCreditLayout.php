<?php

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserCreditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('user.credit.point')
                ->required()
                ->value(0)
                ->title('Credit')
                ->type('number'),
        ];
    }
}
