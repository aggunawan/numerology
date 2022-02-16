<?php

namespace App\Services;

use App\Contracts\NumerologyCategory;
use App\Objects\Numerology;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Exception;

class NumerologyService
{
    private $formulaService;

    public function __construct(FormulaService $formulaService)
    {
        $this->formulaService = $formulaService;
    }

    /**
     * @throws Exception
     */
    public function buildNumerology(Carbon $carbon, NumerologyCategory $category): Numerology
    {
        $sheet = $this->formulaService->getInitialSpreadSheet(
            $carbon->format('d'),
            $carbon->format('n'),
            $carbon->format('Y')
        );

        return new Numerology($sheet, $category);
    }
}
