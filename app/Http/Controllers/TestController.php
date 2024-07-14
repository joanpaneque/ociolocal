<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class TestController extends Controller
{
    public function index() {

        // $user = User::find(auth()->user()->id);

        // $user->companies()->create([
        //     'name' => 'Company 1',
        //     'description' => 'Company 1 description'
        // ]);


        dd([
            'user_company' => auth()->user()->companies()->with('schedule')->get()->toArray()
        ]);

        // return response()->json([
        //     'user_company' => $user->companies()
        // ]);
    }
}
