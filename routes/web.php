<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
*   /user
*/
Route::get('/users', [UserController::class, 'index'])->middleware('auth')->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->middleware('auth')->name('users.create');
Route::post('/users', [UserController::class, 'store'])->middleware('auth')->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->middleware('auth')->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth')->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth')->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth')->name('users.destroy');


/*
*   /users/{user}/activities
*/
Route::get('/users/{user}/activities', [ActivityController::class, 'index'])->middleware('auth')->name('users.activities.index');
Route::get('/users/{user}/activities/create', [activitiesController::class, 'create'])->middleware('auth')->name('users.activities.create');
Route::post('/users/{user}/activities', [activitiesController::class, 'store'])->middleware('auth')->name('users.activities.store');
Route::get('/users/{user}/activities/{activity}', [activitiesController::class, 'show'])->middleware('auth')->name('users.activities.show');
Route::get('/users/{user}/activities/{activity}/edit', [activitiesController::class, 'edit'])->middleware('auth')->name('users.activities.edit');
Route::put('/users/{user}/activities/{activity}', [activitiesController::class, 'update'])->middleware('auth')->name('users.activities.update');
Route::delete('/users/{user}/activities/{activity}', [activitiesController::class, 'destroy'])->middleware('auth')->name('users.activities.destroy');



require __DIR__.'/auth.php';
