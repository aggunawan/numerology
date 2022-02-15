<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\NamedFormula;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class FormulaService
{
    /**
     * @throws Exception
     */
    public function getInitialSpreadSheet(int $day, int $month, int $year): Spreadsheet
    {
        $sheet = new Spreadsheet();
        $sheet->addNamedFormula(new NamedFormula('DD', $sheet->getActiveSheet(), $day));
        $sheet->addNamedFormula(new NamedFormula('MM', $sheet->getActiveSheet(), $month));
        $sheet->addNamedFormula(new NamedFormula('YYYY', $sheet->getActiveSheet(), $year));

        return $sheet;
    }
}
