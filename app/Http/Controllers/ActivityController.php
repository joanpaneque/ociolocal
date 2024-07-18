<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\User;
use App\Models\Company;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user, Company $company)
    {
        return Inertia::render('Activities/Index', [
            'company' => $company
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
