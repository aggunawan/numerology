<?php

namespace App\Orchid\Resources;

use App\Models\SharedPerson;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class SharedPersonResource extends Resource
{
    public static $model = SharedPerson::class;

    public function fields(): array
    {
        return [
            Input::make('name')
                ->required()
                ->title('Name'),
            DateTimer::make('birth_date')
                ->title('Birth Date')
                ->format('Y-m-d')
        ];
    }

    public function rules(Model $model): array
    {
        return [
            'name' => ['required', 'min:1', 'max:255'],
            'birth_date' => ['required', 'date'],
        ];
    }

    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('name'),
            TD::make('birth_date', 'Birth Date')
                ->render(function ($model) {
                    return $model->birth_date->format('d F Y');
                }),
            TD::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
        ];
    }

    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('name'),
            Sight::make('birth_date', 'Birth Date')
                ->render(function ($model) {
                    return $model->birth_date->format('d F Y');
                }),
            Sight::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
            Sight::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public static function permission(): ?string
    {
        return 'shared_people';
    }
}
