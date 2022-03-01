<?php

namespace App\Http\Controllers;

use App\Models\BirthDateList;
use App\Models\Palace;
use App\Models\Person;
use App\Models\SharedPerson;
use App\Models\User;
use App\Objects\BirthDate;
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
        $birthDate = $person->getBirthDate();
        $numerology = new StaticNumerology(
            $birthDate->getDay(),
            $birthDate->getMonth(),
            $birthDate->getYear()
        );

        return view('dashboard.index', [
            'numerology' => $numerology,
            'year_numerology' => new StaticNumerology(
                $birthDate->getDay(),
                $birthDate->getMonth(),
                $birthDate->getYear(),
                $currentYear
            ),
            'name' => $this->gerPersonName($birthDate, $person),
            'months' => $this->getMonths(Carbon::parse("$currentYear-01-01")->isLeapYear()),
            'tab' => $request->get('tab', 'summary'),
            'currentYear' => $currentYear,
            'people' => $this->getPeople(),
            'palaces' => $this->getPalaces(),
            'highlightedYear' => $this->getHighlightedYear($numerology),
        ]);
    }

    private function getBirthDate(): PersonObject
    {
        $list = $this->getBirthDateList();

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

        $user = auth()->user();

        if (count($names) == 0 && $user instanceof User) {
            $names[] = $user->name;
        }

        if ($day == 0 && $month == 0 && $year == 0) {
            $day = (int) date('d');
            $month = (int) date('m');
            $year = (int) date('Y');
        }


        return new PersonObject(implode(', ', $names), "$month/$day/$year");
    }

    private function getMonths(bool $leap): array
    {
        return [
            'January' => [[[10, 5], 'getDayMaster'], [[8, 8], 'getCulture']],
            'February' => [[[9, 5], 'getEducation'], [[8, ($leap ? 7 : 6)], 'getMindset']],
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
        $list = [];

        foreach ($this->getPrivatePersonList() as $i => $person) {
            $list["person-$i"] = $person;
        }

        foreach ($this->getSharedPersonList() as $i => $person) {
            $list["shared_person-$i"] = $person;
        }

        return $list;
    }

    private function getPalaces(): array
    {
        $result = [];
        $palaces = (new Palace())
            ->newQuery()
            ->select(['code', 'name', 'font_color', 'background_color'])
            ->get();

        foreach ($palaces as $palace) {
            $result[$palace->code] = [$palace->name, $palace->background_color, $palace->font_color];
        }

        return $result;
    }

    private function getPrivatePersonList(): array
    {
        return (new Person())
            ->newQuery()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->pluck('name', 'id')
            ->toArray();
    }

    private function getSharedPersonList(): array
    {
        return (new SharedPerson())
            ->newQuery()
            ->pluck('name', 'id')
            ->toArray();
    }

    private function gerPersonName(BirthDate $birthDate, PersonObject $person): string
    {
        if (count(explode(',', $person->getName())) > 1) {
            $list = $this->getBirthDateList();
            $names = [];

            if ($list instanceof BirthDateList) {
                foreach ($list->content as $item) {
                    $names[] = $item['name'] . ' (' . Carbon::parse($item['date'])->diffInYears() . ')';
                }
                return implode(', ', $names);
            }
        }

        $carbon = Carbon::parse("{$birthDate->getYear()}-{$birthDate->getMonth()}-{$birthDate->getDay()}");
        $age = null;

        if ($carbon->diffInYears() == 1) $age = "(1 year)";
        if ($carbon->diffInYears() > 1) $age = "({$carbon->diffInYears()} years)";

        return "{$person->getName()} {$carbon->format('d-m-Y')} $age";
    }

    private function getBirthDateList()
    {
        return (new BirthDateList())
            ->newQuery()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->first();
    }

    private function getHighlightedYear(StaticNumerology $numerology): int
    {
        $methods = [
            'getDayMaster',
            'getCulture',
            'getEducation',
            'getMindset',
            'getBelief',
            'getCareer',
            'getPartner',
            'getAmbition',
            'getTalent',
            'getBusiness',
            'getIntellectual',
            'getSpiritual',
            'getEmotional',
            'getSocial',
            'getRelationship',
            'getFinancial',
            'getSon',
            'getDaughter',
            'getCharacter',
            'getHealth',
            'getPhysical',
        ];

        $years = collect();

        foreach ($methods as $method) {
            $years->push($numerology->{$method}()->getYear());
        }

        $years = $years->sort();
        $current = date('Y');

        foreach ($years as $i => $year) {
            if ($i == 0 && $year > $current) return $year;
            if ($i != 0 && $year > $current) return $years[$i - 1];
        }

        return $years->last();
    }

}
