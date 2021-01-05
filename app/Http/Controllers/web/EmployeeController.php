<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use App\Position;
use Auth;
use Validator;

class EmployeeController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(5);

        return view('web.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.employee.create');
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
            'fname'                                 => 'required',
            'lname'                                 => 'required',
            'gender'                                => 'required',
            'civil_status'                          => 'required',
            'birthday'                              => 'required|date',
            'email'                                 => 'required|email|unique:employees,email',
        ]);

        if (!$validate->fails()) {
            $employee = new Employee();
            $employee->fill($request->all());

            $employee->save();

            return redirect()->route('web.employees.edit', $employee)
                             ->with('status', [
                                'msg'   => 'Employee Created!',
                                'variant'   => 'success',
                             ]);
        } else {
            return redirect()->back()
                             ->withErrors($validate)
                             ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $managers = Employee::whereHas('employment.position', function($query){
            $query->where('mngr', 1);
        })->get();

        return view('web.employee.edit', compact('employee', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validate = Validator::make($request->all(), [
            'fname'                                 => 'required',
            'lname'                                 => 'required',
            'gender'                                => 'required',
            'civil_status'                          => 'required',
            'birthday'                              => 'required|date',
            'email'                                 => 'required|email|unique:employees,email,'.$employee->id,
        ]);
        if (!$validate->fails()) {
            $employee->fill($request->all());

            $employee->save();

            return redirect()->route('web.employees.edit', $employee)
                             ->with('status', [
                                'msg'       => 'Employee Record has been updated!',
                                'variant'   => 'success',
                             ]);
        } else {
            return redirect()->route('web.employees.edit', $employee)
                             ->withErrors($validate)
                             ->withInput();
        }
    }

    public function updateEmploymentRecord(Request $request, Employee $employee)
    {
        $employment = $employee->employment;

        $employment->employed = isset($request->employed);
        $employment->is_permanent = isset($request->is_permanent);
        $employment->onboard_date = $request->onboard_date;
        $employment->offboard_date = $request->offboard_date;
        $employment->position_id = $request->position_id;
        $employment->working_hrs = $request->working_hrs;
        $employment->immediate_mngr = $request->immediate_mngr;
        $employment->approving_mngr = $request->approving_mngr;

        $salary = new \App\Salary();

        $salary->employee_id = $employee->id;
        $salary->amount = $request->amount;
        $salary->effective_date = $request->effective_date;
        $salary->allowance_rice = $request->allowance_rice;
        $salary->allowance_transpo = $request->allowance_transpo;
        $salary->allowance_laundry = $request->allowance_laundry;
        $salary->allowance_other = $request->allowance_other;

        if(!\App\Salary::whereDate('effective_date', $request->effective_date)->first()) {
            $salary->save();
        }

        if($employment->save()) {
            $message = 'Employment Record Updated!';
            $var = 'success';
        } else {
            $message = 'Something went wrong!';
            $var = 'danger';
        }

        return redirect()->back()->with('status', [
            'msg'   => $message,
            'variant'    => $var,
            'panel' =>  'employment',
        ]);
    }

    public function updateEntitlementRecord(Request $request, Employee $employee)
    {
        $entitlement = $employee->entitlement;
        $entitlement->fill($request->all());
        if($entitlement->save()) {
            $message = 'Leave Entitlement Record Updated!';
            $var = 'success';
        } else {
            $message = 'Something went wrong!';
            $var = 'danger';
        }

        return redirect()->back()
                         ->with('status', [
                            'msg'   =>  $message,
                            'variant'   => $var,
                            'panel'     => 'entitlement',
                         ]);
    }

    public function resendVerification(Employee $employee)
    {
        $employee->user->sendEmailVerificationNotification();

        return redirect()->back()
                         ->with('status', [
                            'msg'   => 'Verification Link Resent',
                            'variant'   =>  'success',
                         ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if($employee->delete()) {
            $message = 'Employee removed!';
            $var = 'success';
        } else {
            $message = 'Something went wrong!';
            $var = 'danger';
        }

        return redirect()->back()
                         ->with('status', [
                            'msg'   => $message,
                            'variant'    => $var,
                         ]);
    }


    public function restore(Employee $employee)
    {
        if ($employee->trashed()) {
            $employee->resotre();
            return response()->json([
                'message'       => 'Employee Restored'
            ]);
        }
    }

    public function deletePermanent(Employee $employee)
    {
        if ($employee->trashed()) {
            $employee->forceDelete();
            return response()->json([
                'message'       => 'Employee Permanently Removed'
            ]);
        }
    }
}
