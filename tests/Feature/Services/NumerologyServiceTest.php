<?php

namespace Tests\Feature\Services;

use App\Models\Category;
use App\Services\NumerologyService;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Exception;
use Tests\TestCase;

class NumerologyServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testBuildNumerology()
    {
        $app = app(NumerologyService::class);
        $category = Category::factory()->make();
        $categoryWithAdditionalYear = Category::factory()->make(['year_formula' => '=YYYY+2']);
        $categoryWithInvalidYearFormula = Category::factory()->make(['year_formula' => '=Y+2']);
        $categoryWithInvalidFixYear = Category::factory()->make(['year_formula' => '2']);

        if ($app instanceof NumerologyService && $category instanceof Category) {
            self::assertSame(
                2020, ($app->buildNumerology(Carbon::parse('2020-01-01'), $category))->getYear()
            );
        }

        if ($app instanceof NumerologyService && $categoryWithAdditionalYear instanceof Category) {
            self::assertSame(
                2022,
                ($app->buildNumerology(Carbon::parse('2020-01-01'), $categoryWithAdditionalYear))->getYear()
            );
        }

        if ($app instanceof NumerologyService && $categoryWithInvalidYearFormula instanceof Category) {
            self::assertSame(
                0,
                ($app->buildNumerology(Carbon::parse('2020-01-01'), $categoryWithInvalidYearFormula))->getYear()
            );
        }

        if ($app instanceof NumerologyService && $categoryWithInvalidFixYear instanceof Category) {
            self::assertSame(
                2,
                ($app->buildNumerology(Carbon::parse('2020-01-01'), $categoryWithInvalidFixYear))->getYear()
            );
        }
    }
}
