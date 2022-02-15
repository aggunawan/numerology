<?php

namespace Tests\Feature\Services;

use App\Services\FormulaService;
use PhpOffice\PhpSpreadsheet\Calculation\Exception as CalculationException;
use PhpOffice\PhpSpreadsheet\Exception;
use Tests\TestCase;

class FormulaServiceTest extends TestCase
{
    /**
     * @throws Exception
     * @throws CalculationException
     */
    public function testGetInitialSpreadSheet()
    {
        $app = app(FormulaService::class);

        if ($app instanceof FormulaService) {
            $sheet = $app->getInitialSpreadSheet('1', '2', '2020');

            self::assertSame(
                1,
                (int) $sheet ->getNamedFormula('DD')->getValue()
            );

            self::assertSame(
                2,
                (int) $sheet->getNamedFormula('MM')->getValue()
            );

            self::assertSame(
                2020,
                (int) $sheet->getNamedFormula('YYYY')->getValue()
            );
        }
    }
}
