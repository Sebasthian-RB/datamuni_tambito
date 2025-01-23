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

use App\Http\Controllers\VasoDeLecheControllers\VasoDeLecheController;


//Controladores deL Área: ÁREA DE LA MUJER
use App\Http\Controllers\AreaDeLaMujerControllers\AmPersonController;
use App\Http\Controllers\AreaDeLaMujerControllers\AmPersonEventController;
use App\Http\Controllers\AreaDeLaMujerControllers\AmPersonInterventionController;
use App\Http\Controllers\AreaDeLaMujerControllers\AmPersonViolenceController;
use App\Http\Controllers\AreaDeLaMujerControllers\EventController;
use App\Http\Controllers\AreaDeLaMujerControllers\InterventionController;
use App\Http\Controllers\AreaDeLaMujerControllers\ProgramController;
use App\Http\Controllers\AreaDeLaMujerControllers\ViolenceController;

use App\Http\Controllers\AreaDeLaMujerControllers\AmDashboardController; //dashboard de AM
use App\Http\Controllers\AreaDeLaMujerControllers\OmDashboardController;
// Controladores del Área: Sisfoh

use App\Http\Controllers\SisfohControllers\EnumeratorController;
use App\Http\Controllers\SisfohControllers\InstrumentController;
use App\Http\Controllers\SisfohControllers\InstrumentVisitController;
use App\Http\Controllers\SisfohControllers\SfhRequestController;
use App\Http\Controllers\SisfohControllers\SfhDwellingSfhPersonController;
use App\Http\Controllers\SisfohControllers\SfhDwellingController;
use App\Http\Controllers\SisfohControllers\SfhPersonController;
use App\Http\Controllers\SisfohControllers\VisitController;

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

use App\Http\Controllers\CiamControllers\CiamDashboardController; //dashboard de CIAM

//Controladores deL Área: OMAPED
use App\Http\Controllers\OmapedControllers\CaregiverController;
use App\Http\Controllers\OmapedControllers\DisabilityController;
use App\Http\Controllers\OmapedControllers\OmDwellingController;
use App\Http\Controllers\OmapedControllers\OmPersonController;

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
    Route::get('/am_dashboard', [AmDashboardController::class, 'index'])->name('amdashboard');

    // Rutas de los controladores de Vaso de Leche dentro del grupo de autenticación    
    Route::resource('committees', CommitteeController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sectors', SectorController::class);
    Route::resource('vl_family_members', VlFamilyMemberController::class);
    Route::resource('vl_family_members_products', VlFamilyMemberProductController::class);
    Route::resource('vl_minors', VlMinorController::class);
    Route::get('/vaso-de-leche', [VasoDeLecheController::class, 'index'])->name('vaso-de-leche.index');

        //Rutas de "committee_vl_family_members" (Padrón de Beneficiarios)
        Route::get('padron-de-beneficiarios/{committee_id}', [CommitteeVlFamilyMemberController::class, 'index'])->name('committee_vl_family_members.index');

    
    Route::get('committee_vl_family_members/create', [CommitteeVlFamilyMemberController::class, 'create'])->name('committee_vl_family_members.create'); // Formulario de creación
    Route::post('committee_vl_family_members', [CommitteeVlFamilyMemberController::class, 'store'])->name('committee_vl_family_members.store'); // Almacenar el nuevo miembro
    Route::get('committee_vl_family_members/{committee_vl_family_member}', [CommitteeVlFamilyMemberController::class, 'show'])->name('committee_vl_family_members.show'); // Ver detalles de un miembro
    Route::get('committee_vl_family_members/{committee_vl_family_member}/edit', [CommitteeVlFamilyMemberController::class, 'edit'])->name('committee_vl_family_members.edit'); // Formulario de edición
    Route::put('committee_vl_family_members/{committee_vl_family_member}', [CommitteeVlFamilyMemberController::class, 'update'])->name('committee_vl_family_members.update'); // Actualizar un miembro
    Route::delete('committee_vl_family_members/{committee_vl_family_member}', [CommitteeVlFamilyMemberController::class, 'destroy'])->name('committee_vl_family_members.destroy'); // Eliminar un miembro



    // Rutas de los controladores de Sisfoh dentro del grupo de autenticación
    Route::resource('enumerators', EnumeratorController::class);
    Route::resource('instruments', InstrumentController::class);
    Route::resource('instrument_visits', InstrumentVisitController::class);
    Route::resource('sfh_dwelling_sfh_people', SfhDwellingSfhPersonController::class);
    Route::resource('sfh_dwelling', SfhDwellingController::class);
    Route::resource('sfh_people', SfhPersonController::class);
    Route::resource('sfh_requests', SfhRequestController::class);
    Route::resource('visits', VisitController::class);


    // Rutas de los controladores de Ciam dentro del grupo de autenticación    
    Route::resource('elderly_adults', ElderlyAdultController::class);
    Route::resource('elderly_adult_guardians', ElderlyAdultGuardianController::class);
    Route::resource('elderly_adult_private_insurances', ElderlyAdultPrivateInsuranceController::class);
    Route::resource('elderly_adult_social_programs', ElderlyAdultSocialProgramController::class);
    Route::resource('guardians', GuardianController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('private_insurances', PrivateInsuranceController::class);
    Route::resource('public_insurances', PublicInsuranceController::class);
    Route::resource('social_programs', SocialProgramController::class);

    Route::get('/ciam_dashboard', [CiamDashboardController::class, 'index'])->name('ciamdashboard');

    // Rutas de los controladores de Sisfoh dentro del grupo de autenticación
    Route::resource('caregivers', CaregiverController::class);
    Route::resource('om-dwellings', OmDwellingController::class);
    Route::resource('disabilities', DisabilityController::class);
    Route::resource('om-people', OmPersonController::class);
    Route::get('/om_dashboard', [OmDashboardController::class, 'index'])->name('omdashboard');

});
