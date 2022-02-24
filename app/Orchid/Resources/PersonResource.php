<?php

namespace App\Orchid\Resources;

use App\Events\PersonExcelImported;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Orchid\Attachment\Models\Attachment;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Upload;
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
                ->title('Name'),
            DateTimer::make('birth_date')
                ->title('Birth Date')
                ->format('Y-m-d'),
            Quill::make('note')
                ->toolbar(["text", "color", "header", "list", "format"])
                ->title('Note'),
            Upload::make('excel')
                ->title('Excel')
                ->acceptedFiles(implode(',', [
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
                    'application/vnd.ms-excel',
                    'application/vnd.ms-excel.sheet.macroEnabled.12',
                ]))
                ->maxFiles(1),
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
            $request->request->add(['user_id' => auth()->user()->getAuthIdentifier()]);
            parent::onSave($request, $model);
        } else {
            $this->parseExcel($this->getUploadedExcels()[0]);
        }
    }

    private function getUploadedExcels()
    {
        return collect(request()->all()['model'])->get('excel', []);
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
                new PersonExcelImported(
                    auth()->user()->getAuthIdentifier(),
                    storage_path("/app/public/$file->path$file->name.$file->extension")
                )
            );
        }
    }
}
