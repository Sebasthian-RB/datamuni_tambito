<?php

namespace App\Http\Controllers\CiamControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CiamDashboardController extends Controller
{
    public function index()
    {
        return view('areas.CiamViews.CiamDashboard');
    }
}
