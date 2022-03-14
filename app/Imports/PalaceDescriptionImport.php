<?php

namespace App\Imports;

use App\Models\Palace;
use App\Models\PalaceDescription;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PalaceDescriptionImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            if (isset($item['code'])) {
                $palace = $this->getPalace($item['code']);
                if ($palace instanceof Palace) {
                    if ($palace->palaceDescription instanceof PalaceDescription) {
                        $this->updatePalaceDescription($palace->palaceDescription, $item);
                    } else {
                        $this->createPalaceDescription($palace, $item);
                    }
                }
            }
        }
    }

    private function getPalace(int $code)
    {
        return (new Palace())
            ->newQuery()
            ->where('code', $code)
            ->with(['palaceDescription'])
            ->first();
    }

    private function updatePalaceDescription(PalaceDescription $palaceDescription, Collection $collection)
    {
        foreach ($this->geAttributes($collection) as $key => $attribute) {
            foreach ($attribute as $i => $value) {
                $attr = $palaceDescription->{$key};
                $attr[$i] = $value;
                $palaceDescription->{$key} = $attr;
            }
        }
        $palaceDescription->save();
    }

    private function createPalaceDescription(Palace $palace, Collection $collection): void
    {
        $palaceDescription = new PalaceDescription();
        $palaceDescription->palace()->associate($palace);
        $palaceDescription->fill($this->geAttributes($collection));

        $palaceDescription->save();
    }

    private function geAttributes(Collection $collection): array
    {
        return [
            'day_master' => [$collection->get('row') => ['Description' => $collection->get('day_master')]],
            'culture' => [$collection->get('row') => ['Description' => $collection->get('culture')]],
            'education' => [$collection->get('row') => ['Description' => $collection->get('education')]],
            'mindset' => [$collection->get('row') => ['Description' => $collection->get('mindset')]],
            'belief' => [$collection->get('row') => ['Description' => $collection->get('belief')]],
            'career' => [$collection->get('row') => ['Description' => $collection->get('career')]],
            'partner' => [$collection->get('row') => ['Description' => $collection->get('partner')]],
            'ambition' => [$collection->get('row') => ['Description' => $collection->get('ambition')]],
            'talent' => [$collection->get('row') => ['Description' => $collection->get('talents')]],
            'business' => [$collection->get('row') => ['Description' => $collection->get('business')]],
            'intellectual' => [$collection->get('row') => ['Description' => $collection->get('intellectual')]],
            'spiritual' => [$collection->get('row') => ['Description' => $collection->get('spiritual')]],
            'emotional' => [$collection->get('row') => ['Description' => $collection->get('enjoyment')]],
            'social' => [$collection->get('row') => ['Description' => $collection->get('social')]],
            'relationship' => [$collection->get('row') => ['Description' => $collection->get('relationship')]],
            'financial' => [$collection->get('row') => ['Description' => $collection->get('financial')]],
            'son' => [$collection->get('row') => ['Description' => $collection->get('son')]],
            'daughter' => [$collection->get('row') => ['Description' => $collection->get('daughter')]],
            'character' => [$collection->get('row') => ['Description' => $collection->get('character')]],
            'health' => [$collection->get('row') => ['Description' => $collection->get('health')]],
            'physical' => [$collection->get('row') => ['Description' => $collection->get('physical')]],
            'goal' => [$collection->get('row') => ['Description' => $collection->get('goal')]],
        ];
    }
}
