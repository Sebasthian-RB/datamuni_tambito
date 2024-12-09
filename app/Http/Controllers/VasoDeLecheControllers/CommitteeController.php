<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Models\VasoDeLecheModels\Committee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('areas.VasoDeLecheViews.Committees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areas.VasoDeLecheViews.Committees.create');
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
    public function show(Committee $committee)
    {
        return view('areas.VasoDeLecheViews.Committees.show', compact('committee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Committee $committee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Committee $committee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Committee $committee)
    {
        //
    }
}
