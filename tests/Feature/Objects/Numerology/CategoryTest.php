<?php

namespace Tests\Feature\Objects\Numerology;

use App\Objects\Numerology\Category;
use Illuminate\Foundation\Testing\WithFaker;
use ReflectionProperty;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use WithFaker;

    public function testGetName()
    {
        $category = new Category("Foo", $this->faker->year());
        self::assertSame("Foo", $category->getName());
    }

    public function testGetYear()
    {
        $year = (int) $this->faker->year();
        self::assertSame($year, (new Category("Foo", $year))->getYear());
    }

    public function testAddTrait()
    {
        $category = new Category('Foo', 2020);
        $category->addTrait(1);

        $prop = new ReflectionProperty(Category::class, 'traitCodes');
        $prop->setAccessible(true);

        self::assertSame([1], $prop->getValue($category));
    }

    public function testGetTrait()
    {
        $category = new Category('Foo', 2020);
        $traits = [
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

        for ($i = 0; $i < 23; $i++) {
            $category->addTrait($i);
        }

        self::assertSame($traits, $category->getTraits());
        self::assertSame([1 => 'The Magician'], (new Category('Foo', 2020))->addTrait(1)->getTraits());
    }

    public function testGetTraitCodes()
    {
        $category = new Category('Foo', 2020);
        $category->addTrait(1);
        $category->addTrait(2);

        self::assertSame([1,2], $category->getTraitCodes());
    }
}
