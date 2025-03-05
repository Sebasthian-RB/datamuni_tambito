<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SfhHomeController extends Controller
{
    /**
     * Muestra la página principal del área de CIAM.
     */
    public function index(): View
    {
        return view('areas.SisfohViews.SisfohHome');
    }
}
