<?php

namespace Tests\Feature\Factories;

use Database\Factories\CategoryFactory;
use Tests\TestCase;

class CategoryFactoryTest extends TestCase
{
    public function testGetDefinition()
    {
        $factory = new CategoryFactory();
        self::assertTrue(isset($factory->definition()['name']));
        self::assertTrue(isset($factory->definition()['year_formula']));
    }
}
