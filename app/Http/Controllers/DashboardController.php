<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Objects\StaticNumerology;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $carbon = Carbon::parse($this->getBirthDate($request));
        $currentYear = $request->get('year', now()->format('Y'));

        return view('dashboard.index', [
            'birth_date' => $carbon->format('m/d/Y'),
            'numerology' => new StaticNumerology(
                $carbon->format('d'),
                $carbon->format('m'),
                $carbon->format('Y')
            ),
            'year_numerology' => new StaticNumerology(
                $carbon->format('d'),
                $carbon->format('m'),
                $carbon->format('Y'),
                $currentYear
            ),
            'months' => $this->getMonths(),
            'tab' => $request->get('tab', 'summary'),
            'currentYear' => $currentYear,
        ]);
    }

    private function getBirthDate(Request $request): string
    {
        $user = auth()->user();
        $date = now()->toDateString();

        if ($user instanceof User && $user->birth_date) $date = $user->birth_date;
        if (collect($request->all())->filter()->has('birth_date'))
            $date = Carbon::parse($request->get('birth_date'))->toDateString();

        return $date;
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
}
