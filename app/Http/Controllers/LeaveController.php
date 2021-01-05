<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function setApproval(Leave $leave)
    {
        $approval = [
            'Pending', 'Approved', 'Declined', 'Cancelled'
        ];

        $set = isset($_GET['set']) ? $_GET['set'] : 0;

        Auth::loginUsingId(request('user_id'));

        if (Auth::user()->isAdmin() || Auth::user()->superuser) {
            if ($leave->approved == $set) {
                return response()->json([
                    'errors'    => [
                        'message'   => 'Your leave request is already ' . $approval[$set],
                    ]
                ]);
            }
            $leave->approved = $set;
            $leave->approved_by = Auth::user()->id;
            $leave->save();

            if($set == 1) {
                $ent = \App\Entitlement::where('employee_id', $leave->employee_id)->first();
                $from = \Carbon\Carbon::parse($leave->from_date);
                $to = \Carbon\Carbon::parse($leave->to_date);
                $total = $ent->{$leave->type} - $to->diffInDays($from);
                if ($total > 0) {
                    $ent->{$leave->type} = $total;
                    $ent->save();
                } else {
                    return response()->json([
                        'errors'    => [
                            'message'   => 'You will exceed your maximum amount of leave',
                            'balance' => $total,
                            'type' => $ent->{$leave->type},
                            'days' => $to->diffInDays($from)
                        ]
                    ]);
                }
            }

            return response()->json([
                'message'       => 'Leave Request ' . $approval[$set],
                'result'        => $leave,
            ]);
        } else {
            return response()->json([
                'errors' => [
                    'message'   => 'Unauthorized Access',
                ]
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approved = isset($_GET['approved']) ? $_GET['approved'] : null;
        $leave = Leave::with('employee', 'approveUser', 'hours')->get();
        if(!is_null($approved)) {
            $leave = Leave::with('employee', 'approveUser', 'hours')->where('approved', $approved)->get();
        }

        return response()->json($leave);
    }

    public function approvedList()
    {
        $leave = Leave::with('employee', 'approveUser', 'hours')->where('approved', 1)->get();

        return response()->json($leave);
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

    public function whosOut()
    {
        $today = Leave::with('employee', 'approveuser')
                      ->where('approved', 1)
                      ->whereDate('from_date', '<=', \Carbon\Carbon::now())
                      ->whereDate('to_date', '>=', \Carbon\Carbon::now())
                      ->get();

        $tomorrow = Leave::with('employee', 'approveuser')
                      ->where('approved', 1)
                      ->whereDate('from_date', '<=', \Carbon\Carbon::now()->addDay())
                      ->whereDate('to_date', '>=', \Carbon\Carbon::now()->addDay())
                      ->get();

        $week = Leave::with('employee', 'approveuser')
                      ->where('approved', 1)
                      ->whereDate('from_date', '>=', \Carbon\Carbon::now()->startOfWeek())
                      ->whereDate('to_date', '<=', \Carbon\Carbon::now()->endOfWeek())
                      ->get();
        return response()->json([
            'today'         => $today,
            'tomorrow'      => $tomorrow,
            'week'          => $week
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'type'=> 'required',
            'from_date'=> 'required',
            'to_date'=> 'required',
        ]);

        if (!$validate->fails()) {
            $leave = new Leave();
            $leave->fill($request->all());
            $leave->save();

            return response()->json([
                'message'       => 'Leave Request Pending',
                'result'        => $leave
            ]);
        } else {
            return response()->json([
                'errors'        => $validate->errors(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        return response()->json([
            'leave'     => $leave,
            'approved'  => $leave->approveUser,
            'hours'     => $leave->hours,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        if (request()->ajax()) {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        $validate = Validator::make($request->all(), [
            'type'=> 'required',
            'from_date'=> 'required',
            'to_date'=> 'required',
        ]);

        if (!$validate->fails()) {
            $leave->fill($request->all());
            $leave->save();

            return response()->json([
                'message'       => 'Leave Request Pending',
                'result'        => $leave
            ]);
        } else {
            return response()->json([
                'errors'        => $validate->errors(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        if ($leave->delete()) {
            $message = 'Leave Request has been removed';
        } else {
            $message = 'Something went wrong';
        }
        return response()->json([
            'message'       => $message,
        ]);
    }

    public function permanentDelete(Leave $leave)
    {
        if ($leave->trashed()) {
            $leave->resotre();
            return response()->json([
                'message'       => 'Leave Request Resotred'
            ]);
        }
    }

    public function restore(Leave $leave)
    {
        if ($leave->trashed()) {
            $leave->forceDelete();
            return response()->json([
                'message'       => 'Leave Request Permanently Removed'
            ]);
        }
    }
}
