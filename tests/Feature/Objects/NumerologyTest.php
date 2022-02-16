<?php

namespace Tests\Feature\Objects;

use App\Models\Category;
use App\Objects\Numerology;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Tests\TestCase;

class NumerologyTest extends TestCase
{
    public function testGetCategory()
    {
        $category = new Category(['year_formula' => '2020']);
        $numerology = new Numerology(new Spreadsheet(), $category);

        self::assertSame($category, $numerology->getCategory());
    }

    public function testGetYear()
    {
        $category = new Category(['year_formula' => '2020']);
        $numerology = new Numerology(new Spreadsheet(), $category);

        self::assertSame(2020, $numerology->getYear());

        $category = new Category(['year_formula' => 'Foo']);
        $numerology = new Numerology(new Spreadsheet(), $category);

        self::assertSame(0, $numerology->getYear());

        $category = new Category();
        $numerology = new Numerology(new Spreadsheet(), $category);

        self::assertSame(0, $numerology->getYear());
    }
}
