<?php

namespace App\Traits;

use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Upload;

trait HasPersonInput
{
    public function fields(): array
    {
        $fields = collect([
            Input::make('name')
                ->title('Name'),
            DateTimer::make('birth_date')
                ->title('Birth Date')
                ->format('Y-m-d'),
            Quill::make('note')
                ->toolbar(["text", "color", "header", "list", "format"])
                ->title('Note'),
        ]);

        if (request()->route()->getName() == 'platform.resource.create') {
            $fields->push(
                Upload::make('excel')
                    ->title('Excel')
                    ->acceptedFiles(implode(',', [
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
                        'application/vnd.ms-excel',
                        'application/vnd.ms-excel.sheet.macroEnabled.12',
                        'text/csv',
                    ]))
                    ->maxFiles(1)
            );
        }

        return $fields->toArray();
    }
}
