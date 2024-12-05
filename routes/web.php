<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VasoDeLecheControllers\CommitteeController;
use App\Http\Controllers\VasoDeLecheControllers\CommitteeVasoLecheFamilyMemberController;
use App\Http\Controllers\VasoDeLecheControllers\ProductController;
use App\Http\Controllers\VasoDeLecheControllers\SectorController;
use App\Http\Controllers\VasoDeLecheControllers\VasoLecheFamilyMemberController;
use App\Http\Controllers\VasoDeLecheControllers\VasoLecheFamilyMemberProductController;
use App\Http\Controllers\VasoDeLecheControllers\VasoLecheMinorController;

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
});



Route::resource('committees', CommitteeController::class);
Route::resource('committee_vaso_leche_family_members', CommitteeVasoLecheFamilyMemberController::class);
Route::resource('products', ProductController::class);
Route::resource('sectors', SectorController::class);
Route::resource('vaso_leche_family_members', VasoLecheFamilyMemberController::class);
Route::resource('vaso_leche_family_members_products', VasoLecheFamilyMemberProductController::class);
Route::resource('vaso_leche_minors', VasoLecheMinorController::class);