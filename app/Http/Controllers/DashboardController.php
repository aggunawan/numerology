<?php

namespace App\Http\Controllers;

use App\Models\BirthDateList;
use App\Models\Palace;
use App\Models\PalaceDescription;
use App\Models\User;
use App\Objects\BirthDate;
use App\Objects\Person as PersonObject;
use App\Objects\StaticNumerology;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'people' => [],
            'palaces' => $this->getPalaces(),
            'highlightedYear' => $this->getHighlightedYear($numerology),
            'descriptions' => $this->getDescriptions($numerology),
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

    private function getPalaces(): array
    {
        $result = [];
        $palaces = (new Palace())
            ->newQuery()
            ->select(['code', 'name', 'font_color', 'background_color'])
            ->get();

        foreach ($palaces as $palace) {
            $result[$palace->code] = [
                $palace->name,
                $palace->background_color,
                $palace->font_color,
                $palace->description,
            ];
        }

        return $result;
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

    private function getDescriptions(StaticNumerology $staticNumerology): array
    {
        $descriptions = [];
        $palaceDescriptions = (new PalaceDescription())
            ->newQuery()
            ->with([
                'palace' => function ($query) {
                    return $query->select('id', 'name', 'code');
                }
            ])
            ->get();

        foreach ($this->getRemarkOrder() as $item) {
            $row = 1;
            $descriptions[$item] = [];
            $attr = $item == 'Enjoyment' ? 'Emotional' : $item;
            foreach ($staticNumerology->{Str::camel("get$attr")}()->getTraitCodes() as $code) {
                $palaceDescription = $palaceDescriptions->where('palace.code', $code)->first();
                if ($palaceDescription instanceof PalaceDescription) {
                    if (isset($palaceDescription->{Str::snake($attr)}[$row]['Description'])) {
                        $descriptions[$item][] = [
                            'title' => $palaceDescription->palace->name,
                            'description' => $palaceDescription->{Str::snake($attr)}[$row]['Description']
                        ];
                    }
                } else {
                    $descriptions[$item][] = [];
                }
                $row ++;
            }
        }

        return $descriptions;
    }

    private function getRemarkOrder(): array
    {
        return [
            'Day Master',
            'Mindset',
            'Education',
            'Culture',
            'Talent',
            'Partner',
            'Belief',
            'Career',
            'Ambition',
            'Business',
            'Spiritual',
            'Enjoyment',
            'Social',
            'Intellectual',
            'Relationship',
            'Son',
            'Daughter',
            'Financial',
            'Character',
            'Health',
            'Physical',
            'Goal',
        ];
    }
}
