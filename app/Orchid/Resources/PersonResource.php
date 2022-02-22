<?php

namespace App\Orchid\Resources;

use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class PersonResource extends Resource
{
    public static $model = Person::class;

    public function paginationQuery(ResourceRequest $request, Model $model): Builder
    {
        return $model->newQuery()->where('user_id', auth()->user()->getAuthIdentifier());
    }

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
        return [ ];
    }

    public function rules(Model $model): array
    {
        return [
            'name' => ['required', 'min:1', 'max:255'],
            'birth_date' => ['required', 'date'],
        ];
    }

    public function onSave(ResourceRequest $request, Model $model)
    {
        $request->request->add(['user_id' => auth()->user()->getAuthIdentifier()]);
        parent::onSave($request, $model);
    }
}
