<?php

namespace App\Http\Controllers;


use App\Models\Employement;
use Illuminate\Http\Request;

class EmployementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$employement = Employement::all();

        return view('employer-dashboard.employement');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employer-dashboard.create-employement');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employement  $employement
     * @return \Illuminate\Http\Response
     */
    public function show(Employement $employement)
    {
        return view('employements.show', compact("employement"));
    }

    public function showOnDashboard(Employement $employement)
    {
        //$employement = Employement::find($employement);
        return view('employer-dashboard.employements.show',compact("employement"));
    }

    public function proposal(Employement $employement)
    {
        return view('employer-dashboard.employements.proposal', compact("employement"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employement  $employement
     * @return \Illuminate\Http\Response
     */
    public function edit(Employement $employement)
    {
        return view('employer-dashboard.employements.edit',compact("employement"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employement  $employement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employement $employement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employement  $employement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employement $employement)
    {
        //
    }
}
