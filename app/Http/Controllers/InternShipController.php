<?php

namespace App\Http\Controllers;

use App\Models\InternShip;
use Illuminate\Http\Request;

class InternShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employer-dashboard.internships.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employer-dashboard.create-internship');
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
     * @param  \App\Models\InternShip  $internShip
     * @return \Illuminate\Http\Response
     */
    public function show(InternShip $internship)
    {
        return view('internships.show', compact("internship"));
    }

    public function showOnDashboard(InternShip $internship)
    {
        return view('employer-dashboard.internships.show', compact("internship"));
    }

    public function proposal(InternShip $internship)
    {
        return view('employer-dashboard.internships.proposal', compact("internship"));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InternShip  $internShip
     * @return \Illuminate\Http\Response
     */
    public function edit(InternShip $internship)
    {
        return view('employer-dashboard.internships.edit', compact("internship"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InternShip  $internShip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternShip $internShip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InternShip  $internShip
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternShip $internShip)
    {
        //
    }
}
