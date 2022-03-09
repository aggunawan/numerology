<?php

namespace App\Orchid\Resources;

use App\Events\PalaceDescriptionExcelImported;
use App\Models\Palace;
use App\Models\PalaceDescription;
use App\View\Components\PalaceDescriptionTable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Orchid\Attachment\Models\Attachment;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;
use Psr\Container\ContainerExceptionInterface as ContainerExceptionInterfaceAlias;
use Psr\Container\NotFoundExceptionInterface as NotFoundExceptionInterfaceAlias;

class PalaceDescriptionResource extends Resource
{
    public static $model = PalaceDescription::class;

    /**
     * @throws BindingResolutionException
     */
    public function fields(): array
    {
        $fields = collect();
        if (request()->route()->action['as'] == 'platform.resource.create')
            $fields = $fields->merge($this->uploadExcel());

        return $fields->merge($this->inputFields())->toArray();
    }

    /**
     * @throws ContainerExceptionInterfaceAlias
     * @throws NotFoundExceptionInterfaceAlias
     */
    private function getUploadedExcels()
    {
        return collect(request()->get('model'))->get('excel', []);
    }

    /**
     * @throws ContainerExceptionInterfaceAlias
     * @throws NotFoundExceptionInterfaceAlias
     */
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
            event(new PalaceDescriptionExcelImported(
                storage_path("app/public/$file->path$file->name.$file->extension")
            ));
        }
    }

    public function rules(Model $model): array
    {
        return [
            'palace_id' => [
                Rule::requiredIf(function () {
                    return count($this->getUploadedExcels()) == 0;
                }),
            ],
        ];
    }

    public function with(): array
    {
        return ['palace'];
    }

    public static function permission(): ?string
    {
        return 'palace_descriptions';
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

    /**
     * @throws BindingResolutionException
     */
    private function inputFields(): array
    {
        return [
            Relation::make('palace_id')
                ->fromModel(Palace::class, 'name')
                ->title('Palace'),
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
            Matrix::make('goal')->title('Goal')->columns(['Description'])
        ];
    }

    private function uploadExcel(): array
    {
        return [
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
        ];
    }
}
