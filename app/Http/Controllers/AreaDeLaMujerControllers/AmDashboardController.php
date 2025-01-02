<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Http\Controllers\Controller;
use App\Models\AreaDeLaMujerModels\Event;
use App\Models\AreaDeLaMujerModels\Intervention;
use App\Models\AreaDeLaMujerModels\Violence;
use Illuminate\Http\Request;

class AmDashboardController extends Controller
{
    public function index()
    {
        return view('areas.AreaDeLaMujerViews.ADLMDashboard');
    }
}
