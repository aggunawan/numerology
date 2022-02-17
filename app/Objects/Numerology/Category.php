<?php

namespace App\Objects\Numerology;

class Category
{
    private $name;
    private $year;
    private $traitCodes = [];
    private $traits = [
        'The Fool',
        'The Magician',
        'The High Priestess',
        'The Empress',
        'The Emperor',
        'The Hierophant',
        'The Lovers',
        'The Chariot',
        'Strength',
        'The Hermit',
        'Wheel of Fortune',
        'Justice',
        'The Hanged Man',
        'Death',
        'Temperance',
        'The Devil',
        'The Tower',
        'The Star',
        'The Moon',
        'The Sun',
        'Judgement',
        'The World',
        'The Fool',
    ];

    public function __construct(string $name, int $year)
    {
        $this->name = $name;
        $this->year = $year;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function addTrait(int $trait): self
    {
        $this->traitCodes[] = $trait;
        return $this;
    }

    public function getTraits(): array
    {
        $traits = [];

        foreach ($this->traitCodes as $code) {
            $traits[$code] = $this->traits[$code];
        }

        return $traits;
    }

    public function getTraitCodes(): array
    {
        return $this->traitCodes;
    }
}
