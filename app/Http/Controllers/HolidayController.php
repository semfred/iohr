<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = Holiday::all();

        return response()->json($holidays);
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
        $holiday = new Holiday();
        $holiday->fill($request->all());
        if ($holiday->save()) {
            return response()->json([
                'message'       => 'Holiday Created',
                'result'        => $holiday,
            ]);
        } else {
            return response()->json([
                'errors'        => [
                    'message'       => 'Something went wrong'
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        return response()->json($holiday);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        if (request()->ajax()) {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        $holiday->fill($request->all());
        if ($holiday->save()) {
            return response()->json([
                'message'       => 'Holiday Updated',
                'result'        => $holiday,
            ]);
        } else {
            return response()->json([
                'errors'        => [
                    'message'       => 'Something went wrong'
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        //
    }

    public function permanentDelete(Holiday $holiday)
    {

    }

    public function restore(Holiday $holiday)
    {
        
    }
}
