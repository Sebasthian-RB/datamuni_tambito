<?php

namespace App\Http\Controllers\CiamControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\CiamModels\ElderlyAdult;

class CiamDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 📌 Cantidad de adultos por edad
        $adultsByAge = DB::table('elderly_adults')
            ->selectRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) as age, COUNT(id) as count')
            ->groupBy('age')
            ->orderBy('age')
            ->get();
        
        // 📌 Cantidad de adultos por enfermedad
        $adultsByDisability = DB::table('elderly_adults')
        ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(type_of_disability, "$[0]")) as disability, COUNT(id) as count')
        ->whereNotNull('type_of_disability')
        ->where('type_of_disability', '!=', '[]')
        ->groupBy('disability')
        ->get();

        // Nueva consulta para cumpleaños por mes
    $birthdaysByMonth = DB::table('elderly_adults')
    ->selectRaw('MONTH(birth_date) as month, COUNT(id) as count')
    ->whereNotNull('birth_date')
    ->groupBy('month')
    ->orderBy('month')
    ->get();


        // 📌 Pasar datos a la vista
        return view('areas.CIAMViews.CIAMDashboard', [
            'adultsByAge' => $adultsByAge,
            'adultsByDisability' => $adultsByDisability,
            'birthdaysByMonth' => $birthdaysByMonth,

        ]);
    }


}
