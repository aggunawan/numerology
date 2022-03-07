<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Input;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class NameFilter extends Filter
{
    public function name(): string
    {
        return 'Name ';
    }

    public function parameters(): ?array
    {
        return ['name'];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('name', 'like', "%{$this->request->get('name')}%");
    }

    public function display(): iterable
    {
        return [
            Input::make('name')->title('Name'),
        ];
    }
}
