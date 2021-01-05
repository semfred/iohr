<?php

namespace App\Http\Controllers;

use Validator;
use App\Employment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employment = Employment::with('employee', 'salary', 'position', 'immediateManager', 'approvingManager')->get();
        return response()->json($employment);
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
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employment  $employment
     * @return \Illuminate\Http\Response
     */
    public function show(Employment $employment)
    {
        return response()->json([
            'employment_details'        => $employment,
            'employee_info'             => $employment->employee,
            'salary'                    => $employment->salary,
            'position'                  => $employment->position,
            'i_manager'                 => $employment->immediateManager,
            'a_manager'                 => $employment->approvingManager,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employment  $employment
     * @return \Illuminate\Http\Response
     */
    public function edit(Employment $employment)
    {
        if (request()->json()) {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employment  $employment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employment $employment)
    {
        $validate = Validator::make($request->all(), [
            'position_id'               => 'required',
            'working_hrs'               => 'required',
            'basicSalary'               => 'required|numeric',
            'onboard_date'              => 'required',
        ]);
        if (!$validate->fails()) {
            $employment->fill($request->all());

            $salary = \App\Salary::updateOrCreate([
                'employee_id'       => $employment->id,
                'amount'            => $request->basicSalary,
                'effective_date'    => $request->effective_date,
            ], [
                'allowance_rice'    => $request->riceAllowance,
                'allowance_transpo' => $request->transpoAllowance,
                'allowance_laundry' => $request->laundryAllowance,
                'allowance_other'   => $request->otherAllowance,
            ]);

            if (isset($request->current) && isset($request->now)) {
                $salary_adjust = \App\Salary::firstOrCreate([
                    'employee_id'       => $employment->id,
                    'amount'            => $request->current,
                    'effective_date'    => $request->effective_date,
                ]);
                $new_salary = \App\Salary::create([
                    'employee_id'       => $employment->id,
                    'amount'            => $request->now,
                    'effective_date'    => $request->effective_date,
                    'allowance_rice'    => $request->riceAllowance,
                    'allowance_transpo' => $request->transpoAllowance,
                    'allowance_laundry' => $request->laundryAllowance,
                    'allowance_other'   => $request->otherAllowance,
                ]);
            }

            $salary->save();
            $employment->save();

            return response()->json([
                'message'       => 'Employment Updated',
                'result'        => [
                    'employment'        => $employment,
                    'position'          => $employment->position,
                    'salary'            => $employment->salary
                ],
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
     * @param  \App\Employment  $employment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employment $employment)
    {
        if ($employment->delete()) {
            $message = 'Employment Info Removed';
        } else {
            $message = 'Something Went Wrong';
        }
        return response()->json([
            'message' => $message
        ]);
    }

    public function restore(Employment $employment)
    {
        if ($employment->trashed()) {
            $employment->restore();
        }
    }

    public function permanentDelete(Employee $employee)
    {
        if ($employment->trashed()) {
            $employment->forceDelete();
        }
    }

}
