<?php

namespace App\Http\Controllers\CiamControllers;

use Illuminate\Http\Request;

class CiamDashboardController extends Controller
{
    public function index()
    {
        return view('areas.CiamViews.CiamDashboard');
    }
}
