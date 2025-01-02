<?php

use App\Http\Controllers\AreaDeLaMujerControllers\AmDashboardController;
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
use App\Http\Controllers\AreaDeLaMujerControllers\AmPersonEventController;
use App\Http\Controllers\AreaDeLaMujerControllers\AmPersonInterventionController;
use App\Http\Controllers\AreaDeLaMujerControllers\AmPersonViolenceController;
use App\Http\Controllers\AreaDeLaMujerControllers\EventController;
use App\Http\Controllers\AreaDeLaMujerControllers\InterventionController;
use App\Http\Controllers\AreaDeLaMujerControllers\ProgramController;
use App\Http\Controllers\AreaDeLaMujerControllers\ViolenceController;
//Controladores deL Área: CIAM
use App\Http\Controllers\CiamControllers\ElderlyAdultController;
use App\Http\Controllers\CiamControllers\ElderlyAdultGuardianController;
use App\Http\Controllers\CiamControllers\ElderlyAdultPrivateInsuranceController;
use App\Http\Controllers\CiamControllers\ElderlyAdultSocialProgramController;
use App\Http\Controllers\CiamControllers\GuardianController;
use App\Http\Controllers\CiamControllers\LocationController;
use App\Http\Controllers\CiamControllers\PrivateInsuranceController;
use App\Http\Controllers\CiamControllers\PublicInsuranceController;
use App\Http\Controllers\CiamControllers\SocialProgramController;



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

    // Rutas de los controladores de Área de la Mujer dentro del grupo de autenticación
    Route::resource('am_people', AmPersonController::class);
    Route::resource('interventions', InterventionController::class);
    Route::resource('violences', ViolenceController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('events', EventController::class);
    Route::resource('am_person_interventions', AmPersonInterventionController::class);
    Route::resource('am_person_violences', AmPersonViolenceController::class);
    Route::resource('am_person_events', AmPersonEventController::class);
    Route::get('/am_dashboard', [AmDashboardController::class, 'index'])->name('dashboard');

    // Rutas de los controladores de Vaso de Lecha dentro del grupo de autenticación    
    Route::resource('committees', CommitteeController::class);
    Route::resource('committee_vl_family_members', CommitteeVlFamilyMemberController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sectors', SectorController::class);
    Route::resource('vl_family_members', VlFamilyMemberController::class);
    Route::resource('vl_family_members_products', VlFamilyMemberProductController::class);
    Route::resource('vl_minors', VlMinorController::class);
});


