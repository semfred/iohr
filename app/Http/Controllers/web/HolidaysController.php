<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Holiday;
use App\Leave;
use App\Employment;
use Carbon\Carbon;
use Artisan;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = Holiday::all();
        return view('web.holidays.index', compact('holidays'));
    }

    public function updateHolidays(Request $request)
    {
        foreach(Holiday::all() as $holiday) {
            $holiday->active = isset($request['holiday_'.$holiday->id]);
            $holiday->save();
        }

        return redirect()->back()
                        ->with('status', [
                        'msg'       => 'Company Holidays updated!',
                        'variant'   => 'success',
                        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.holidays.create');
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
        $holiday->active = isset($request->active);
        $holiday->save();

        return redirect()
                    ->route('web.settings.holidays.index')
                    ->with('status', [
                        'msg'   =>  'New Holiday Created!',
                        'variant'   =>  'success',
                    ]);
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

    public function calendarGet()
    {

        $ret = [];

        foreach(Leave::where('status', 'APP')->where('approved', 1)->get() as $i => $leave)
        {
            if (!empty($leave->employee)) {
                $ret[] = [
                    'start'             =>  $leave->from_date->format('Y-m-d'),
                    'end'               =>  $leave->to_date->addDay()->format('Y-m-d'),
                    'allDay'            =>  true,
                    'title'             =>  ucfirst($leave->type) . ' Leave for ' . $leave->employee->fname,
                    'backgroundColor'   =>  '#2966B8',
                    'borderColor'       =>  '#2966B8',
                    'textColor'         =>  'white',
                    'classNames'        =>  'event event-leave',
                ];
           }
        }

        foreach(Employment::whereNotNull('onboard_date')->whereNotNull('permanent')->where('employed', 1)->get() as $i => $employment)
        {
            if (!empty($employment->employee)) {
                $ret[] = [
                    'start'             =>  $employment->permanent->format('Y-m-d'),
                    'allDay'            =>  true,
                    'title'             =>  'Regularization for ' . $employment->employee->name,
                    'backgroundColor'   =>  '#23819C',
                    'borderColor'       =>  '#23819C',
                    'textColor'         =>  'white',
                    'classNames'        =>  'event event-leave',
                ];
            }
        }

        foreach(Employment::whereNotNull('onboard_date')->where('employed', 1)->get() as $i => $employment)
        {

            if (!empty($employment->employee)) {
                $ret[] = [
                    'start'             =>  $employment->onboard_date->addYear()->format('Y-m-d'),
                    'allDay'            =>  true,
                    'title'             =>  $employment->employee->name . "'s 1st Year Anniversary",
                    'backgroundColor'   =>  '#9669FE',
                    'borderColor'       =>  '#9669FE',
                    'textColor'         =>  'white',
                    'classNames'        =>  'event event-leave',
                ];
            }

        }

        foreach(Holiday::where('active', 1)->get() as $i => $holiday)
        {
            $ret[] = [
                'start'             =>  $holiday->observance,
                'allDay'            =>  true,
                'title'             =>  $holiday->name . ' ' . '(' . $holiday->country . ')',
                'backgroundColor'   =>  '#ea2035',
                'borderColor'       =>  '#ea2035',
                'textColor'         =>  'white',
                'classNames'        =>  'event event-holiday',
            ];
        }

        return response()
                    ->json($ret);
    }

    public function updateHolidayCommand(){
        Artisan::call("update:holidays");
        return redirect('/web/settings/holidays');

    }
}
