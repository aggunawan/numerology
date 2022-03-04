<?php

namespace App\Http\Livewire;

use App\Models\Person;
use App\Models\SharedPerson;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class PersonSelect extends LivewireSelect
{
    public $lists;

    public function options($searchTerm = null) : Collection
    {
        $list = [];

        foreach ($this->getPrivatePersonList($searchTerm) as $i => $person) {
            $list[] = ['value' => "person-$i", 'description' => $person];
        }

        foreach ($this->getSharedPersonList($searchTerm) as $i => $person) {
            $list[] = ['value' => "shared_person-$i", 'description' => $person];
        }

        $this->lists = collect($list);
        return $this->lists;
    }

    private function getPrivatePersonList(string $search): array
    {
        return (new Person())
            ->newQuery()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->where('name', 'like', "%$search%")
            ->pluck('name', 'id')
            ->toArray();
    }

    private function getSharedPersonList(string $search): array
    {
        return (new SharedPerson())
            ->newQuery()
            ->where('name', 'like', "%$search%")
            ->pluck('name', 'id')
            ->toArray();
    }

    public function selectedOption($value): array
    {
        return [
            'value' => $this->value,
            'description' => $this->lists->where('value', $value)->first()['description'],
        ];
    }

    public function styles(): array
    {
        return [
            'default' => 'p-2 rounded border w-full appearance-none',

            'searchSelectedOption' => 'p-2 rounded border w-full bg-white flex items-center',
            'searchSelectedOptionTitle' => 'w-full text-left',
            'searchSelectedOptionReset' => 'h-4 w-4',

            'search' => 'relative',
            'searchInput' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full',
            'searchOptionsContainer' => 'absolute top-0 left-0 mt-12 w-full z-10 border-gray-300',

            'searchOptionItem' => 'p-3 text-white bg-gray-400 cursor-pointer text-sm',
            'searchOptionItemActive' => 'font-medium',
            'searchOptionItemInactive' => 'bg-white font-bolder text-white',

            'searchNoResults' => 'p-8 w-full bg-white border text-center text-xs text-gray-600',
        ];
    }

    public function getListeners(): array
    {
        return collect($this->dependsOn)
            ->mapWithKeys(function ($key) {
                return ["{$key}Updated" => 'updateDependingValue'];
            })
            ->put('clearSelectedPerson', 'clearPerson')
            ->toArray();
    }

    public function clearPerson()
    {
        $this->searchTerm = null;
        $this->value = null;
    }
}
