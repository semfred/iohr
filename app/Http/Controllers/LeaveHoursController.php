<?php

namespace App\Http\Controllers;

use App\LeaveHours;
use Illuminate\Http\Request;

class LeaveHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leavehrs = LeaveHours::with('user', 'leave')->get();

        return response()->json($leavehrs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()) {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveHours  $leaveHours
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveHours $leaveHours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveHours  $leaveHours
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveHours $leaveHours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveHours  $leaveHours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveHours $leaveHours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveHours  $leaveHours
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveHours $leaveHours)
    {
        //
    }
}
