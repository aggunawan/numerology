<?php

namespace App\Orchid\Resources;

use App\Models\Palace;
use App\Models\PalaceDescription;
use App\View\Components\PalaceDescriptionTable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class PalaceDescriptionResource extends Resource
{
    public static $model = PalaceDescription::class;

    /**
     * @throws BindingResolutionException
     */
    public function fields(): array
    {
        return [
            Relation::make('palace_id')
                ->fromModel(Palace::class, 'name')
                ->title('Palace')
                ->required(),
            Matrix::make('day_master')->title('Day Master')->columns(['Description']),
            Matrix::make('culture')->title('Culture')->columns(['Description']),
            Matrix::make('education')->title('Education')->columns(['Description']),
            Matrix::make('mindset')->title('Mindset')->columns(['Description']),
            Matrix::make('belief')->title('Belief')->columns(['Description']),
            Matrix::make('career')->title('Career')->columns(['Description']),
            Matrix::make('partner')->title('Partner')->columns(['Description']),
            Matrix::make('ambition')->title('Ambition')->columns(['Description']),
            Matrix::make('talent')->title('Talent')->columns(['Description']),
            Matrix::make('business')->title('Business')->columns(['Description']),
            Matrix::make('intellectual')->title('Intellectual')->columns(['Description']),
            Matrix::make('spiritual')->title('Spiritual')->columns(['Description']),
            Matrix::make('emotional')->title('Enjoyment')->columns(['Description']),
            Matrix::make('social')->title('Social')->columns(['Description']),
            Matrix::make('relationship')->title('Relationship')->columns(['Description']),
            Matrix::make('financial')->title('Financial')->columns(['Description']),
            Matrix::make('son')->title('Son')->columns(['Description']),
            Matrix::make('daughter')->title('Daughter')->columns(['Description']),
            Matrix::make('character')->title('Character')->columns(['Description']),
            Matrix::make('health')->title('Health')->columns(['Description']),
            Matrix::make('physical')->title('Physical')->columns(['Description']),
            Matrix::make('goal')->title('Goal')->columns(['Description']),
        ];
    }

    public function with(): array
    {
        return ['palace'];
    }


    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('palace_id', 'Palace')->render(function ($model) {
                return $model->palace->name;
            }),
            TD::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
            TD::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }

    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('palace_id', 'Palace')->render(function ($model) {
                return $model->palace->name;
            }),
            Sight::make('description')->component(PalaceDescriptionTable::class),
        ];
    }

    public function filters(): array
    {
        return [];
    }
}
