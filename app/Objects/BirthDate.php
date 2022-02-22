<?php

namespace App\Objects;

class BirthDate
{
    private $day;
    private $month;
    private $year;

    public function __construct(string $date)
    {
        $this->day = explode('/', $date)[1];
        $this->month = explode('/', $date)[0];
        $this->year = explode('/', $date)[2];
    }

    public function getDate(): string
    {
        return "$this->month/$this->day/$this->year";
    }

    public function getDay()
    {
        return $this->day;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getYear()
    {
        return $this->year;
    }
}
