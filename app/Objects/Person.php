<?php

namespace App\Objects;

class Person
{
    private $name;
    private $birth_date;

    public function __construct(string $name, string $birth_date)
    {
        $this->name = $name;
        $this->birth_date = new BirthDate($birth_date);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBirthDate(): BirthDate
    {
        return $this->birth_date;
    }
}
