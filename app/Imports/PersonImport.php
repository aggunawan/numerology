<?php

namespace App\Imports;

use App\Models\Person;
use Carbon\Carbon;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonImport implements ToModel, WithHeadingRow
{
    private $user_id;

    public function __construct(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function model(array $row)
    {
        $day = (int) $row['dd'];
        $month = (int) $row['mm'] == 0 ? $row['mm'] : (int) $row['mm'];
        $year = (int) $row['yyyy'];

        try {
            $carbon = Carbon::parse("$day-$month-$year");
            return new Person([
                'name' => $row['name'],
                'birth_date' => $carbon,
                'user_id' => $this->user_id,
            ]);
        } catch (Exception $ex) {
            return [];
        }
    }
}
