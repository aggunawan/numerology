<?php

namespace App\Imports;

use App\Models\SharedPerson;
use Carbon\Carbon;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SharedPersonImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $day = (int) $row['dd'];
        $month = (int) $row['mm'] == 0 ? $row['mm'] : (int) $row['mm'];
        $year = (int) $row['yyyy'];

        try {
            $carbon = Carbon::parse("$day-$month-$year");
            return new SharedPerson([
                'name' => $row['name'],
                'birth_date' => $carbon
            ]);
        } catch (Exception $ex) {
            return [];
        }
    }
}
