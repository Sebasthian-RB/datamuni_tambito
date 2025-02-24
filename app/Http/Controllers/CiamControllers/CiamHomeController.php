<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CiamHomeController extends Controller
{
    /**
     * Muestra la página principal del área de CIAM.
     */
    public function index(): View
    {
        return view('areas.CiamViews.CiamHome');
    }
}
