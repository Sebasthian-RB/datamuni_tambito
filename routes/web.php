<?php

use App\Http\Controllers\Admin\UserController;
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
use App\Http\Controllers\VasoDeLecheControllers\VasoDeLecheDashboardController;
use App\Http\Controllers\VasoDeLecheControllers\HojaDistribucionExportController;
use App\Http\Controllers\VasoDeLecheControllers\VasoDeLecheExportController;

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
// Controladores del Área: Sisfoh

use App\Http\Controllers\SisfohControllers\EnumeratorController;
use App\Http\Controllers\SisfohControllers\InstrumentController;
use App\Http\Controllers\SisfohControllers\InstrumentVisitController;
use App\Http\Controllers\SisfohControllers\SfhRequestController;
use App\Http\Controllers\SisfohControllers\SfhDwellingSfhPersonController;
use App\Http\Controllers\SisfohControllers\SfhDwellingController;
use App\Http\Controllers\SisfohControllers\SfhPersonController;
use App\Http\Controllers\SisfohControllers\VisitController;

use App\Http\Controllers\SisfohControllers\SfhHomeController; //Menu Principal de Sisfoh
use App\Http\Controllers\SisfohControllers\SfhDashboardController; //dashboard de Sisfoh

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

use App\Http\Controllers\CiamControllers\CiamHomeController; //dashboard de CIAM
use App\Http\Controllers\CiamControllers\CiamDashboardController; //dashboard de CIAM
use App\Http\Controllers\OmapedControllers\AttendanceRecordController;
//Controladores deL Área: OMAPED
use App\Http\Controllers\OmapedControllers\CaregiverController;
use App\Http\Controllers\OmapedControllers\DisabilityController;
use App\Http\Controllers\OmapedControllers\OmDashboardController; //Dashboard de OMAPED
use App\Http\Controllers\OmapedControllers\OmDwellingController;
use App\Http\Controllers\OmapedControllers\OmPersonController;
use App\Http\Controllers\OmapedControllers\PsychologicalConsultationController;
use App\Http\Controllers\OmapedControllers\PsychologicalDiagnosisController;
use App\Http\Controllers\OmapedControllers\PsychologicalSessionController;
use App\Http\Controllers\OmapedControllers\PsychologyDashboardController;
//Roles y permisos
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/help', function () {
    return view('help');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas para el Administrador (puede acceder a todo)
    Route::middleware('role:Administrador|Super Administrador')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::get('users/{user}/assign-permissions', [UserController::class, 'assignPermissionsForm'])->name('users.assignPermissionsForm');
        Route::post('users/{user}/assign-permissions', [UserController::class, 'assignPermissions'])->name('users.assignPermissions');
    });

    // 🔥 Área de la Mujer
    Route::middleware('role:Área de la Mujer|Administrador')->group(function () {
        Route::resource('am_people', AmPersonController::class);
        Route::resource('interventions', InterventionController::class);
        Route::resource('violences', ViolenceController::class);
        Route::resource('programs', ProgramController::class);
        Route::resource('events', EventController::class);
        Route::resource('am_person_interventions', AmPersonInterventionController::class);
        Route::resource('am_person_violences', AmPersonViolenceController::class);
        Route::resource('am_person_events', AmPersonEventController::class);
        Route::get('/am_dashboard', [AmDashboardController::class, 'index'])->name('amdashboard');
    });

    // Rutas de los controladores de Vaso de Leche dentro del grupo de autenticación    
    // 🔥 Vaso de Leche
    Route::middleware('role:Vaso de Leche|Administrador')->group(function () {
        Route::resource('committees', CommitteeController::class);
        Route::resource('products', ProductController::class);
        Route::resource('sectors', SectorController::class);
        Route::resource('vl_family_members', VlFamilyMemberController::class);

        Route::resource('vl_minors', VlMinorController::class);
        Route::get('/vaso-de-leche', [VasoDeLecheController::class, 'index'])->name('vaso-de-leche.index');

        //Rutas de "committee_vl_family_members" (Padrón de Beneficiarios)
        Route::get('padron-de-beneficiarios/{committee_id}', [CommitteeVlFamilyMemberController::class, 'index'])->name('committee_vl_family_members.index');
        Route::get('committee_vl_family_members/create/{committee_id}', [CommitteeVlFamilyMemberController::class, 'create'])->name('committee_vl_family_members.create'); // Formulario de creación
        Route::post('committee_vl_family_members', [CommitteeVlFamilyMemberController::class, 'store'])->name('committee_vl_family_members.store'); // Almacenar el nuevo miembro
        Route::get('committee_vl_family_members/{committee_vl_family_member}', [CommitteeVlFamilyMemberController::class, 'show'])->name('committee_vl_family_members.show'); // Ver detalles de un miembro
        Route::get('committee_vl_family_members/{committee_vl_family_member}/edit', [CommitteeVlFamilyMemberController::class, 'edit'])->name('committee_vl_family_members.edit'); // Formulario de edición
        Route::put('committee_vl_family_members/{committee_vl_family_member}', [CommitteeVlFamilyMemberController::class, 'update'])->name('committee_vl_family_members.update'); // Actualizar un miembro
        Route::delete('committee_vl_family_members/{committee_vl_family_member}', [CommitteeVlFamilyMemberController::class, 'destroy'])->name('committee_vl_family_members.destroy'); // Eliminar un miembro

        //Rutas de "vl_family_members_products" (Hoja de Distribución de Productos)
        Route::get('vl_family_member_products/{committee_id}', [VlFamilyMemberProductController::class, 'index'])->name('vl_family_member_products.index'); // Mostrar lista de productos
        Route::get('vl_family_members_products/create/{committee_id}', [VlFamilyMemberProductController::class, 'create'])->name('vl_family_member_products.create'); // Formulario de creación
        Route::post('vl_family_member_products', [VlFamilyMemberProductController::class, 'store'])->name('vl_family_member_products.store'); // Almacenar el nuevo producto
        Route::get('vl_family_member_products/{vl_family_member_product}', [VlFamilyMemberProductController::class, 'show'])->name('vl_family_member_products.show'); // Ver detalles de un producto
        Route::get('vl_family_member_products/edit/{vl_family_member_product}/{committee_id}', [VlFamilyMemberProductController::class, 'edit'])->name('vl_family_member_products.edit'); // Formulario de edición
        Route::put('vl_family_member_products/{vl_family_member_product}', [VlFamilyMemberProductController::class, 'update'])->name('vl_family_member_products.update'); // Actualizar un producto
        Route::delete('vl_family_member_products/{vl_family_member_product}', [VlFamilyMemberProductController::class, 'destroy'])->name('vl_family_member_products.destroy'); // Eliminar un producto

        //Dashboard
        Route::get('/vaso-de-leche/dashboard', [VasoDeLecheDashboardController::class, 'index'])->name('pvl_dashboard.index');

        //Exportar Padron de Beneficiarios
        Route::get('/export-vaso-de-leche/{committeeId}', [VasoDeLecheExportController::class, 'export'])->name('export.vaso-de-leche');

        //Exportar Hoja de Distribción de Productos
        Route::get('/export-hoja-distribucion/{committeeId}', [HojaDistribucionExportController::class, 'export'])->name('export.hoja-distribucion');
    });


    // Rutas de los controladores de Sisfoh dentro del grupo de autenticación
    // 🔥 SISFOH
    Route::middleware('role:SISFOH|Administrador')->group(function () {
        Route::resource('enumerators', EnumeratorController::class);
        Route::resource('instruments', InstrumentController::class);
        Route::resource('instrument_visits', InstrumentVisitController::class);
        Route::resource('sfh_dwelling_sfh_people', SfhDwellingSfhPersonController::class);
        Route::resource('sfh_dwelling', SfhDwellingController::class);
        Route::resource('sfh_people', SfhPersonController::class);
        Route::resource('sfh_requests', SfhRequestController::class);
        Route::resource('visits', VisitController::class);
        Route::get('/sisfoh_home', [SfhHomeController::class, 'index'])->name('sisfohHome');
        Route::get('/sisfoh_dashboard', [SfhDashboardController::class, 'index'])->name('sfhdashboard');
    });

    // Rutas de los controladores de Ciam dentro del grupo de autenticación    
    // 🔥 CIAM
    Route::middleware('role:CIAM|Administrador')->group(function () {
        Route::resource('elderly_adults', ElderlyAdultController::class);
        Route::resource('guardians', GuardianController::class);
        Route::get('/ciam_home', [CiamHomeController::class, 'index'])->name('CiamHome');
        Route::get('/ciam_dashboard', [CiamDashboardController::class, 'index'])->name('ciamdashboard');
    });

    // Rutas de los controladores de OMAPED dentro del grupo de autenticación
    // 🔥 OMAPED
    Route::middleware('role:OMAPED|Administrador')->group(function () {
        Route::resource('caregivers', CaregiverController::class);
        Route::resource('om-dwellings', OmDwellingController::class);
        Route::resource('disabilities', DisabilityController::class);
        Route::resource('om-people', OmPersonController::class);
        Route::middleware(['permission:psicologiaOmaped'])->group(function () {
            Route::resource('psychological-diagnoses', PsychologicalDiagnosisController::class);
            Route::resource('psychological-sessions', PsychologicalSessionController::class);
        });
        Route::get('/om_dashboard', [OmDashboardController::class, 'index'])->name('omdashboard');
        Route::get('/psy_dashboard', [PsychologyDashboardController::class, 'index'])->name('psydashboard');

    });
});
