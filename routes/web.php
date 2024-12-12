<?php

use Illuminate\Support\Facades\Route;

//Controladores del área: VASO DE LECHE
use App\Http\Controllers\VasoDeLecheControllers\CommitteeController;
use App\Http\Controllers\VasoDeLecheControllers\CommitteeVlFamilyMemberController;
use App\Http\Controllers\VasoDeLecheControllers\ProductController;
use App\Http\Controllers\VasoDeLecheControllers\SectorController;
use App\Http\Controllers\VasoDeLecheControllers\VlFamilyMemberController;
use App\Http\Controllers\VasoDeLecheControllers\VlFamilyMemberProductController;
use App\Http\Controllers\VasoDeLecheControllers\VlMinorController;
//Controladores deL Área: ÁREA DE LA MUJER
use App\Http\Controllers\AreaDeLaMujerControllers\AmPersonController;
use App\Http\Controllers\AreaDeLaMujerControllers\AmPersonInterventionController;
use App\Http\Controllers\AreaDeLaMujerControllers\InterventionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas del controlador AmPerson dentro del grupo de autenticación
    Route::resource('am_people', AmPersonController::class);
    Route::resource('interventions', InterventionController::class);
    Route::resource('violences', AmPersonController::class);
    Route::resource('programs', AmPersonController::class);
    Route::resource('events', AmPersonController::class);
    Route::resource('am_person_interventions', AmPersonInterventionController::class);
    Route::resource('am_person_violences', AmPersonController::class);
    Route::resource('am_person_events', AmPersonController::class);
});



Route::resource('committees', CommitteeController::class);
Route::resource('committee_vl_family_members', CommitteeVlFamilyMemberController::class);
Route::resource('products', ProductController::class);
Route::resource('sectors', SectorController::class);
Route::resource('vl_family_members', VlFamilyMemberController::class);
Route::resource('vl_family_members_products', VlFamilyMemberProductController::class);
Route::resource('vl_minors', VlMinorController::class);