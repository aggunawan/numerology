<?php

namespace App\Http\Controllers;

use App\Models\BirthDateList;
use App\Models\Person;
use App\Objects\Person as PersonObject;
use App\Objects\StaticNumerology;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $person = $this->getBirthDate();
        $currentYear = $request->get('year', now()->format('Y'));

        return view('dashboard.index', [
            'numerology' => new StaticNumerology(
                $person->getBirthDate()->getDay(),
                $person->getBirthDate()->getMonth(),
                $person->getBirthDate()->getYear()
            ),
            'year_numerology' => new StaticNumerology(
                $person->getBirthDate()->getDay(),
                $person->getBirthDate()->getMonth(),
                $person->getBirthDate()->getYear(),
                $currentYear
            ),
            'name' => $person->getName(),
            'months' => $this->getMonths(),
            'tab' => $request->get('tab', 'summary'),
            'currentYear' => $currentYear,
            'people' => $this->getPeople(),
        ]);
    }

    private function getBirthDate(): PersonObject
    {
        $list = (new BirthDateList())
            ->newQuery()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->first();

        $names = [];
        $day = 0;
        $month = 0;
        $year = 0;

        if ($list instanceof BirthDateList) {
            foreach ($list->content as $item) {
                $names[] = $item['name'];
                $date = Carbon::parse($item['date']);
                $day += (int) $date->format('d');
                $month += (int) $date->format('m');
                $year += (int) $date->format('Y');
            }
        }

        if (count($names) == 0) $names[] = auth()->user()->getAuthIdentifierName();
        if ($day == 0 && $month == 0 && $year == 0) {
            $day = (int) date('d');
            $month = (int) date('m');
            $year = (int) date('Y');
        }


        return new PersonObject(implode(', ', $names), "$month/$day/$year");
    }

    private function getMonths(): array
    {
        return [
            'January' => [[[10, 5], 'getDayMaster'], [[8, 8], 'getCulture']],
            'February' => [[[9, 5], 'getEducation'], [[8, 6], 'getMindset']],
            'March' => [[[10, 5], 'getPartner'], [[8, 8], 'getAmbition']],
            'April' => [[[8, 5], 'getEmotional'], [[9, 9], 'getSocial']],
            'May' => [[[7, 5, 4], 'getBelief'], [[5, 5, 5], 'getCareer']],
            'June' => [[[6, 5, 4], 'getTalent'], [[5, 5, 5], 'getBusiness']],
            'July' => [[[7, 5, 4], 'getIntellectual'], [[5, 5, 5], 'getSpiritual']],
            'August' => [[[7, 5, 4], 'getRelationship'], [[5, 5, 5], 'getFinancial']],
            'September' => [[[7, 5, 4], 'getSon'], [[5, 5, 4], 'getDaughter']],
            'October' => [[[7, 5, 4], 'getPhysical'], [[5, 5, 5], 'getGoal']],
            'November' => [[[9, 9, 7, 5], 'getCharacter']],
            'December' => [[[13, 9, 4, 5], 'getHealth']],
        ];
    }

    private function getPeople(): array
    {
        return (new Person())
            ->newQuery()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->pluck('name', 'id')
            ->toArray();
    }
}
