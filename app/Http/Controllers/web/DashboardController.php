<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Leave;
use App\Holiday;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $week = Leave::with('employee')
                            ->where('approved', 1)
                            ->where('status', 'APP')
                            ->whereBetween('from_date', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])
                            // ->whereBetween('to_date', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])
                            ->get();

        $tomorrow = Leave::with('employee')
                            ->where('approved', 1)
                            ->where('status', 'APP')
                            ->whereDate('from_date', '<=', \Carbon\Carbon::now()->addDay())
                            ->whereDate('to_date', '>=', \Carbon\Carbon::now()->addDay())
                            ->get();

        $today = Leave::with('employee')
                            ->where('approved', 1)
                            ->where('status', 'APP')
                            ->whereDate('from_date', '<=', \Carbon\Carbon::now())
                            ->whereDate('to_date', '>=', \Carbon\Carbon::now())
                            ->get();
        $dates = [
            'today' =>  $today,
            'tomorrow'  =>  $tomorrow,
            'week'  =>  $week
        ];

        return view('web.dashboard.index', compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
