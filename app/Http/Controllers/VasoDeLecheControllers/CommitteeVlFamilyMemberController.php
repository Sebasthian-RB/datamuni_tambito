<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VasoDeLecheModels\CommitteeVlFamilyMember;

class CommitteeVlFamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.create');
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
    public function show(CommitteeVlFamilyMember $committeeVlFamilyMember)
    {
        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommitteeVLFamilyMember $committeeVlFamilyMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommitteeVLFamilyMember $committeeVlFamilyMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommitteeVLFamilyMember $committeeVlFamilyMember)
    {
        //
    }
}
