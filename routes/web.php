<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\TestController;

use App\Http\Controllers\PriceController;



Route::get('/test', [TestController::class, 'index'])->name('test.index');

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
*   /users/{user}/companies
*/
Route::get('/users/{user}/companies', [CompanyController::class, 'index'])->middleware('auth')->name('users.companies.index');
Route::get('/users/{user}/companies/create', [CompanyController::class, 'create'])->middleware('auth')->name('users.companies.create');
Route::post('/users/{user}/companies', [CompanyController::class, 'store'])->middleware('auth')->name('users.companies.store');
Route::get('/users/{user}/companies/{company}', [CompanyController::class, 'show'])->middleware('auth')->name('users.companies.show');
Route::get('/users/{user}/companies/{company}/edit', [CompanyController::class, 'edit'])->middleware('auth')->name('users.companies.edit');
Route::put('/users/{user}/companies/{company}', [CompanyController::class, 'update'])->middleware('auth')->name('users.companies.update');
Route::delete('/users/{user}/companies/{company}', [CompanyController::class, 'destroy'])->middleware('auth')->name('users.companies.destroy');


/*
*   /users/{user}/companies/{company}/activities
*/
Route::get('/users/{user}/companies/{company}/activities', [ActivityController::class, 'index'])->middleware('auth')->name('users.companies.activities.index');
Route::get('/users/{user}/companies/{company}/activities/create', [ActivityController::class, 'create'])->middleware('auth')->name('users.companies.activities.create');
Route::post('/users/{user}/companies/{company}/activities', [ActivityController::class, 'store'])->middleware('auth')->name('users.companies.activities.store');
Route::get('/users/{user}/companies/{company}/activities/{activity}', [ActivityController::class, 'show'])->middleware('auth')->name('users.companies.activities.show');
Route::get('/users/{user}/companies/{company}/activities/{activity}/edit', [ActivityController::class, 'edit'])->middleware('auth')->name('users.companies.activities.edit');
Route::put('/users/{user}/companies/{company}/activities/{activity}', [ActivityController::class, 'update'])->middleware('auth')->name('users.companies.activities.update');
Route::delete('/users/{user}/companies/{company}/activities/{activity}', [ActivityController::class, 'destroy'])->middleware('auth')->name('users.companies.activities.destroy');

/*
*   /activities
*/
Route::get('/activities/{activity}', [ActivityController::class, 'show_user'])->middleware('auth')->name('activities.show_user');




Route::post('/create-price', [PriceController::class, 'createProductAndPrice']);
Route::post('/update-price', [PriceController::class, 'updatePrice']);


require __DIR__.'/auth.php';
