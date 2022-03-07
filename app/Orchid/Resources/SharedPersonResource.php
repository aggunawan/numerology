<?php

namespace App\Orchid\Resources;

use App\Events\SharedPersonExcelImported;
use App\Models\SharedPerson;
use App\Orchid\Filters\NameFilter;
use App\Traits\HasPersonInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Orchid\Attachment\Models\Attachment;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class SharedPersonResource extends Resource
{
    use HasPersonInput;

    public static $model = SharedPerson::class;

    public function paginationQuery(ResourceRequest $request, Model $model): Builder
    {
        return $model->newQuery()->orderBy('name');
    }

    public function rules(Model $model): array
    {
        return [
            'name' => [
                Rule::requiredIf(function () {
                    return count($this->getUploadedExcels()) == 0;
                }),
                'max:255'
            ],
            'birth_date' => [
                Rule::requiredIf(function () {
                    return count($this->getUploadedExcels()) == 0;
                })
            ],
        ];
    }

    public function onSave(ResourceRequest $request, Model $model)
    {
        if (count($this->getUploadedExcels()) == 0) {
            parent::onSave($request, $model);
        } else {
            $this->parseExcel($this->getUploadedExcels()[0]);
        }
    }

    private function parseExcel(int $int)
    {
        $file = (new Attachment())->newQuery()->find($int);

        if ($file instanceof Attachment) {
            /**
             * @noinspection PhpUndefinedFieldInspection
             * @noinspection PhpPossiblePolymorphicInvocationInspection
             */
            event(
                new SharedPersonExcelImported(storage_path("/app/public/$file->path$file->name.$file->extension"))
            );
        }
    }

    public function columns(): array
    {
        return [
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
            Sight::make('note'),
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
        return [
            NameFilter::class,
        ];
    }

    public static function permission(): ?string
    {
        return 'shared_people';
    }

    private function getUploadedExcels()
    {
        return collect(request()->all()['model'])->get('excel', []);
    }
}
