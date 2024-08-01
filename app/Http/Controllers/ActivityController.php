<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\User;
use App\Models\Company;
use App\Models\Activity;
use App\Models\Image;
use App\Models\ActivityImage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user, Company $company)
    {

        $upcoming_activities = $company->activities()->upcoming()->with('images')->get();
        $in_progress_activities = $company->activities()->inProgress()->with('images')->get();
        $past_activities = $company->activities()->past()->with('images')->get();


        return Inertia::render('Activities/Index', [
            'company' => $company,
            'upcoming_activities' => $upcoming_activities,
            'in_progress_activities' => $in_progress_activities,
            'past_activities' => $past_activities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user, Company $company)
    {
        return Inertia::render('Activities/Create', [
            'company' => $company
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user, Company $company)
    {
        $error = [];

        // 'activity_name': null,
        // 'season': false,
        // 'date_start': null,
        // 'date_end': null,
        // 'date_event': null,
        // 'weekly_schedule': {
        //     'monday': [],
        //     'tuesday': [],
        //     'wednesday': [],
        //     'thursday': [],
        //     'friday': [],
        //     'saturday': [],
        //     'sunday': []
        // },
        // 'ticket_types': [{
        //     'name': "Entrada general",
        //     'price': null
        // }],
        // 'contribution': '10'

        // VALIDATIONS

        //
        // activity_name
        //
        if (empty(trim($request->activity_name))) {
            $error['activity_name'] = "El nombre de la actividad no puede estar vacío";
        }

        //
        // season
        //
        if ($request->season === null) {
            $error['season'] = "La temporada no puede estar vacía";
        }

        //
        // dates
        //
        if ($request->season) {
            //
            // date_start
            //
            if (empty(trim($request->date_start))) {
                $error['date_start'] = "La fecha de inicio no puede estar vacía";
            } else if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $request->date_start)) {
                $error['date_start'] = "La fecha de inicio no es válida";
            }

            //
            // date_end
            //
            if (empty(trim($request->date_end))) {
                $error['date_end'] = "La fecha de fin no puede estar vacía";
            } else if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $request->date_end)) {
                $error['date_end'] = "La fecha de fin no es válida";
            }
        } else {
            //
            // date_event
            //
            if (empty(trim($request->date_event))) {
                $error['date_event'] = "La fecha del evento no puede estar vacía";
            } else if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $request->date_event)) {
                $error['date_event'] = "La fecha del evento no es válida";
            }
        }

        //
        // weekly_schedule
        //
        // No validation needed

        //
        // max_concurrent_people
        //
        if (!is_numeric($request->max_concurrent_people)) {
            $error['max_concurrent_people'] = "El número máximo de personas concurrentes no es válido";
        }

        //
        // ticket_types
        //
        if (count($request->ticket_types) === 0) {
            $error['ticket_types'] = "Debes añadir al menos un tipo de entrada";
        } else {
            foreach ($request->ticket_types as $ticket_type) {
                //
                // name
                //
                if (empty(trim($ticket_type['name']))) {
                    $error['ticket_types'] = "El nombre del tipo de entrada no puede estar vacío";
                    break;
                }

                //
                // price
                //
                if (empty(trim($ticket_type['price']))) {
                    $error['ticket_types'] = "El precio del tipo de entrada no puede estar vacío";
                    break;
                }
            }
        }

        //
        // contribution
        //
        if (empty(trim($request->contribution))) {
            $error['contribution'] = "La aportación no puede estar vacía";
        }

        //
        // images
        //
        if (!$request->hasFile('images')) {
            $error['images'] = "Debes añadir al menos una imagen";
        }

        if (count($error) > 0) {
            return back()->withErrors($error);
        }

        // store the activity
        $activity = Activity::create([
            'activity_name' => $request->activity_name,
            'season' => $request->season,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'date_event' => $request->date_event,
            'max_concurrent_people' => $request->max_concurrent_people,
            'weekly_schedule' => is_array($request->weekly_schedule) ? json_encode($request->weekly_schedule) : $request->weekly_schedule,
            'contribution' => $request->contribution,
            'ticket_types' => json_encode($request->ticket_types),
            'company_id' => $company->id
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $hash = md5($image->getClientOriginalName() . time() . uniqid());
                $image->move(public_path('images'), $hash);
                $imagePaths[] = "/images/{$hash}";
            }
        }

        foreach ($imagePaths as $imagePath) {
            $image = Image::create([
                'url' => $imagePath
            ]);

            ActivityImage::create([
                'activity_id' => $activity->id,
                'image_id' => $image->id
            ]);
        }



        return redirect()->route('users.companies.activities.index', ['user' => $user->id, 'company' => $company->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function show_user(Activity $activity)
    {
        return Inertia::render('Activities/ShowUser', [
            'activity' => $activity->load('images', 'company')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
