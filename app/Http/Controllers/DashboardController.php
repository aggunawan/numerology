<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $date = ($user instanceof User) ? $user->birth_date : now()->toDateString();

        return view('dashboard.index', [
            'birth_date' => Carbon::parse($date)->format('m/d/Y')
        ]);
    }
}
