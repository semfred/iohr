<?php

namespace App\Http\Controllers\web;

use Validator;
use App\User;
use App\Employee;
use App\Leave;
use App\Notifications\CancelLeave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::find(Auth::user()->employee_id);
        return view('web.profile.index', compact('employee'));
    }

    public function requests()
    {
        $user = Auth::user();

        $requests = \App\Leave::where('employee_id', $user->employee_info->id)->orderBy('created_at', 'DESC')->paginate(5);

        return view('web.profile.requests', compact('user', 'requests'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $validate = Validator::make($request->all(), [
            'password'                  => 'required|confirmed',
        ]);

        if(!$validate->fails()) {
            $user->fill($request->all());
            $user->password = bcrypt($request->password);
            $user->password_changed = true;
            $user->save();

            return redirect()->route('web.profile.index')
                                ->with('status', [
                                    'msg'   =>  'Password successfully changed.',
                                    'variant'   =>  'success',
                                ]);
        } else {
            return redirect()->back()
                                ->withErrors($validate->errors());
        }
    }

    public function changePassword()
    {
        return view('web.profile.changepw', [
            'user'  =>  Auth::user(),
        ]);
    }

    public function cancelLeave(Leave $leave, $status = "cancel")
    {
        if($leave->approved) {
            return redirect()->back()
            ->with('status', [
                'msg'   => 'Leave already ' . getStatus($leave->status),
                'variant'   => 'danger',
            ]);
        }

        $stat = strtoupper(substr($status, 0, 3));
        $leave->status = $stat;
        $leave->approved = true;

        if($leave->save()) {
            $message = 'Leave Cancelled. Management has been notified.';
            $var = "success";
            $admin = User::where('type', 'admin')->get();
            foreach($admin as $i => $adminuser) {
                $adminuser->notify(new CancelLeave($leave));
            }
        } else {
            $message = "Something went wrong!";
            $var = "danger";
        }

        return redirect()->route('web.profile.requests')
                         ->with('status', [
                            'msg'   => $message,
                            'variant'   => $var,
                         ]);
    }

    public function viewEmployment()
    {
        $employment = Auth::user()->employee_info->employment;
        return view('web.profile.employment', compact('employment'));
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
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employee)
    {
        $employee = Employee::find($employee);

        if(Auth::user()->employee_id !== $employee->user->id) abort(401);

        $validate = Validator::make($request->all(), [
            'fname'                                 => 'required',
            'lname'                                 => 'required',
            'gender'                                => 'required',
            'civil_status'                          => 'required',
            'birthday'                              => 'required|date',
            'email'                                 => 'required|email|unique:employees,email,'.$employee->id,
        ]);
        if (!$validate->fails()) {
            $employee->fill($request->except('email'));

            $employee->save();

            return redirect()->route('web.profile.index', $employee)
                             ->with('status', [
                                'msg'       => 'Your Personal Record has been updated!',
                                'variant'   => 'success',
                             ]);
        } else {
            return redirect()->route('web.profile.index', $employee)
                             ->withErrors($validate)
                             ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
