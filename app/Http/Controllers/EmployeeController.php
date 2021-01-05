<?php

namespace App\Http\Controllers;

use Validator;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('user', 'leave_requests', 'employment', 'employment.salary', 'employment.position', 'employment.immediateManager', 'employment.approvingManager', 'entitlement')->get();
        if (count($employees)) {
            return response()->json($employees);
        } else {
            return response()->json([
                'error' => [
                    'message' => 'No Employee Records Available'
                ],
            ]);
        }

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

            return response()->json([
                'message'       => 'Employee Created',
                'result'        => $employee,
            ]);
        } else {
            return response()->json(['errors' => $validate->errors()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json([
            'employee'              => $employee,
            'employment'            => $employee->employment,
            'leave_entitlement'     => $employee->entitlement,
            'position'              => isset($employee->employment) ? $employee->employment->position : null,
            'user'                  => $employee->user,
            'leave'                 => $employee->leave_requests,
            'salary'                => isset($employee->employment->salary) ? $employee->employment->salary : null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        if (request()->ajax()) {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
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
            'email'                                 => 'required|email|unique:employees,email,'.$employee,
        ]);

        if (!$validate->fails()) {
            $employee->fill($request->all());

            $employee->save();

            return response()->json([
                'message'       => 'Employee Updated',
                'result'        => $employee,
            ]);
        } else {
            return response()->json(['errors' => $validate->errors()]);
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
        if ($employee->delete()) {
            $message = 'Employee has been removed';
            $status = true;
        } else {
            $message = 'Something went wrong';
            $status = false;
        }
        return response()->json([
            'message'       => $message,
            'success'        => $status,
        ]);
    }

    public function restore(Employee $employee)
    {
        if ($employee->trashed()) {
            $employee->resotre();
            return response()->json([
                'message'       => 'Employee Resotred'
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
