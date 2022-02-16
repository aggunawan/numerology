<?php

namespace App\Objects;

use App\Contracts\NumerologyCategory;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use TypeError;

class Numerology
{
    public const YEAR = 'A1';

    private $spreadsheet;
    private $category;

    public function __construct(Spreadsheet $spreadsheet, NumerologyCategory $category)
    {
        $this->spreadsheet = $spreadsheet;
        $this->category = $category;

        $this->spreadsheet->getActiveSheet()->setCellValue(self::YEAR, $category->getYearFormula());
    }

    public function getCategory(): NumerologyCategory
    {
        return $this->category;
    }

    public function getYear(): int
    {
        try {
            return $this->spreadsheet->getActiveSheet()->getCell(self::YEAR)->getCalculatedValue();
        } catch (Exception | TypeError $e) {
            return 0;
        }
    }
}
