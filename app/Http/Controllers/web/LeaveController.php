<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Leave;
use App\LeaveAttachment;
use App\File;
use App\Holiday;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Notifications\LeaveStatusUpdate;
use App\Notifications\LeaveRequestSent;


class LeaveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.superuser', ['except' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $col = [
            'archived'  =>  0,
        ];


        if( !is_null($request->type) && $request->type !== 'all') {

            $col['type'] = $request->type;
        }

        if( !is_null($request->status) && $request->status !== 'def') {

            $col['status'] = $request->status;
        }

        $leaves = Leave::where('archived', 0)
                    ->where($col)
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);

        return view('web.leave.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $admin = User::where('type', 'admin')->get();



        // if(!Auth::user()->employee_info->employment->isPermanent())
        // {
        //     abort(401);
        // }


        $leave = new Leave();
        $leave->fill($request->all());
        $leave->from_date = Carbon::createFromFormat('Y-m-d', $request->startDate);
        $leave->to_date = Carbon::createFromFormat('Y-m-d', $request->toDate);
        $leave->days = $this->getDaysOfLeave($leave);
        $leave->employee_id = Auth::user()->employee_id;

        $type = $leave->type;
        $isAvail = $leave->days < $leave->employee->entitlement->$type;

        if($leave->employee->employment->is_permanent) {
            if($leave->employee->entitlement->$type && !$isAvail) {
                return redirect()
                            ->back()
                            ->with('status', [
                                'msg'       =>  'Your leave entitlement is insufficient. You have ' . $leave->employee->entitlement->$type . ' ' . $type . ' leave.',
                                'variant'       =>  'danger',
                            ]);
            }
        }


        if($leave->save()) {
            $message = 'Leave Request has been sent to the Admin';
            $var = 'success';
            foreach($admin as $i => $adminuser) {
                $adminuser->notify(new LeaveRequestSent($leave));
            }
        }

        // if($request->hasFile('attachment'))
        // {
        //     $file = $this->uploadFile($request->attachment, 'A');
        //     if($file) {
        //         $attachment = new LeaveAttachment();
        //         $attachment->file_id = $file->id;
        //         $attachment->leave_id = $leave->id;
        //         $attachment->save();
        //     } else {
        //         return redirect()
        //                     ->back()
        //                     ->with('status', [
        //                         'msg'       => 'Something went wrong with your file.',
        //                         'variant'       => 'danger',
        //                     ]);
        //     }
        // }

        return redirect()
                    ->back()
                    ->with('status', [
                        'msg'       => $message,
                        'variant'       => $var,
                    ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
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
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }

    public function changeLeaveStatus(Leave $leave, $status)
    {
        if($leave->approved) {
            return redirect()->back()
            ->with('status', [
                'msg'   => 'Leave already ' . getStatus($leave->status),
                'variant'   => 'danger',
            ]);
        }

        return view('web.leave.change_status', compact('leave', 'status'));
    }

    public function updateLeaveStatus(Request $request, Leave $leave, $status)
    {
        if($leave->approved) {
            return redirect()->back()
            ->with('status', [
                'msg'   => 'Leave already ' . getStatus($leave->status),
                'variant'   => 'danger',
            ]);
        }

        if($leave->employee->employment->is_permanent) {
            if(!$this->calculateEntitlement($leave, $status) && $status !== 'decline') {
                return redirect()->back()
                ->with('status', [
                'msg'   => 'Leave entitlement exceeded',
                'variant'   => 'danger',
                ]);
            }
        }

        $stat = strtoupper(substr($status, 0, 3));
        $leave->approved_by = Auth::user()->id;
        $leave->status = $stat;
        $leave->status_note = $request->status_note;
        $leave->approved = true;

        if($leave->save()) {
            $message = $leave->employee->name . '\'s ' . ucfirst($leave->type) . " Leave set to " . ucfirst($status);
            $var = "success";

            if($request->hasFile('attachment'))
            {
                if($file = $this->uploadFile($request->attachment, 'A')) {
                    $attachment = new LeaveAttachment();
                    $attachment->file_id = $file->id;
                    $attachment->leave_id = $leave->id;
                    $attachment->save();
                } else {
                    return redirect()
                                ->back()
                                ->with('status', [
                                    'msg'       => 'Something went wrong with your file.',
                                    'variant'       => 'danger',
                                ]);
                }
            }

            $leave->employee->user->notify(new LeaveStatusUpdate($leave));
        } else {
            $message = "Something went wrong!";
            $var = "danger";
        }

        return redirect()->route('web.requests.index')
                         ->with('status', [
                            'msg'   => $message,
                            'variant'   => $var,
                         ]);

    }

    private function getDaysOfLeave(Leave $leave)
    {
        $dates = CarbonPeriod::create($leave->from_date, $leave->to_date);
        $days = 0;
        foreach($dates as $i => $date) {
            $datestr = explode(' ', $date->toDateTimeString())[0];

            if(!$date->isWeekend() && !Holiday::where('observance', $datestr)->where('active', 1)->exists()) {
                $days++;
            }
        }

        return $days;
    }

    private function calculateEntitlement(Leave $leave, $status)
    {
        $entitlement = $leave->employee->entitlement;
        $type = $leave->type;
        if($entitlement->$type !== null) {
            if($leave->days >= $entitlement->$type) return false;
            if($status == 'approve') {
                $entitlement->$type = $entitlement->$type - $leave->days;
                $entitlement->save();
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
}
