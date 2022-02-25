<?php

namespace App\Orchid\Resources;

use App\Models\Palace;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class PalaceResource extends Resource
{
    public static $model = Palace::class;

    public function fields(): array
    {
        return [
            Input::make('code')->required()->type('number')->title('Code'),
            Input::make('name')->required()->title('Name'),
            Input::make('description')->required()->title('Description'),
            Input::make('font_color')->required()->title('Font Color (Hexadecimal)'),
            Input::make('background_color')->required()->title('Background Color (Hexadecimal)'),
        ];
    }

    public function rules(Model $model): array
    {
        $unique = "unique:palaces,code";
        if ($model instanceof Palace) $unique .= ",$model->id";
        return [
            'code' => ['required', 'numeric', 'min:0', 'max:255', $unique],
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['required', 'string', 'min:1', 'max:255'],
            'font_color' => ['required', 'string', 'min:1', 'max:7', 'starts_with:#'],
            'background_color' => ['required', 'string', 'min:1', 'max:7', 'starts_with:#'],
        ];
    }

    public function columns(): array
    {
        return [
            TD::make('code'),
            TD::make('name'),
            TD::make('font_color', 'Font Color')->render(function ($model) {
                return "<button style=\"background-color: $model->font_color; color: $model->font_color;\">$model->font_color</button>";
            }),
            TD::make('background_color', 'Background Color')->render(function ($model) {
                return "<button style=\"background-color: $model->background_color; color: $model->background_color;\">$model->background_color</button>";
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
            Sight::make('code'),
            Sight::make('name'),
            Sight::make('description'),
            Sight::make('font_color', 'Font Color')->render(function ($model) {
                return "<button style=\"background-color: $model->font_color; color: $model->font_color;\">$model->font_color</button>";
            }),
            Sight::make('background_color', 'Background Color')->render(function ($model) {
                return "<button style=\"background-color: $model->background_color; color: $model->background_color;\">$model->background_color</button>";
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
        return 'palaces';
    }
}
