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

        // 📌 Pasar datos a la vista
        return view('areas.CIAMViews.CIAMDashboard', [
            'adultsByAge' => $adultsByAge,
        ]);
    }
}
