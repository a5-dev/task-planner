<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Carbon\CarbonPeriod;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $date = CarbonImmutable::parse($request->input('date') ?? now());

        foreach (CarbonPeriod::create($date->startOfWeek(), $date->endOfWeek()) as $dayOfTheWeek) {
            /** @var \Carbon\Carbon $dayOfTheWeek */
            $dateTaskLists[$dayOfTheWeek->toDateString()] = $request->user()->tasks->where('to_do_date', $dayOfTheWeek);
        }

        return Inertia::render('Dashboard', [
            'date' => $date,
            'dateTaskLists' => $dateTaskLists ?? [],
            'lists' => $request->user()->taskLists->load('tasks'),
        ]);
    }
}
