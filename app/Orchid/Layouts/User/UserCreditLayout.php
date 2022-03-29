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
                ->title('Credit')
                ->type('number'),
        ];
    }
}
