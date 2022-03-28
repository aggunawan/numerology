<?php

namespace App\Orchid\Actions;

use Illuminate\Support\Collection;
use Orchid\Crud\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

class BulkDeletePersonAction extends Action
{
    public function button(): Button
    {
        return Button::make('Delete')->icon('trash');
    }

    public function handle(Collection $models)
    {
        $models->each(function ($each) {
            $each->delete();
        });

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        Toast::message('Data has been deleted.');
    }
}
