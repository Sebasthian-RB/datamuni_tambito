<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\Violence;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViolenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $violences = Violence::all();
        return view('areas.AreaDeLaMujerViews.Violencess.index', compact('violences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Violence $violence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Violence $violence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Violence $violence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Violence $violence)
    {
        //
    }
}
