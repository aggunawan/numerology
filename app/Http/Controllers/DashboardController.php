<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Objects\StaticNumerology;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $date = ($user instanceof User) ? $user->birth_date : now()->toDateString();
        $carbon = Carbon::parse($date);

        return view('dashboard.index', [
            'birth_date' => $carbon->format('m/d/Y'),
            'numerology' => new StaticNumerology(
                $carbon->format('d'),
                $carbon->format('m'),
                $carbon->format('Y')
            )
        ]);
    }
}
