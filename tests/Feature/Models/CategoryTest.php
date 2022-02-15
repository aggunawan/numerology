<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testGetYearFormula()
    {
        $category = new Category(['year_formula' => 'foo']);
        self::assertSame('foo', $category->getYearFormula());
    }
}
