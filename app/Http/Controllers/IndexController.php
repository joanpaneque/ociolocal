<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Activity;

class IndexController extends Controller
{
    public function index()
    {


        $activities = Activity::with('images')->get()->toArray();

        // order desc by discount
        usort($activities, function ($a, $b) {
            return $b['discount'] - $a['discount'];
        });

        return Inertia::render('Welcome', [
            'activities' => $activities
        ]);
    }
}
