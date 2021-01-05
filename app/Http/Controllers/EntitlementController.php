<?php

namespace App\Http\Controllers;

use Validator;
use App\Entitlement;
use Illuminate\Http\Request;

class EntitlementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ent = Entitlement::with('employee')->get();
        return response()->json($ent);
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
        if (request()->ajax()) {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entitlement  $entitlement
     * @return \Illuminate\Http\Response
     */
    public function show(Entitlement $entitlement)
    {
        return response()->json($entitlement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entitlement  $entitlement
     * @return \Illuminate\Http\Response
     */
    public function edit(Entitlement $entitlement)
    {
        if (request()->ajax()) {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entitlement  $entitlement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entitlement $entitlement)
    {
        $validate = Validator::make($request->all(), [
            'vacation'          => 'required|integer|min:0',
            'sick'              => 'required|integer|min:0',
        ]);

        if (!$validate->fails()) {
            $entitlement->fill($request->all());
            
            $entitlement->save();

            return response()->json([
                'message'       => 'Entitlement for Employee #'.$entitlement->employee_id.' Updated',
                'result'        => $entitlement,
            ]);
        } else {
            return response()->json([
                'errors' => $validate->errors(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entitlement  $entitlement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entitlement $entitlement)
    {
        if ($entitlement->delete()) {
            $message = 'Entitlement has been removed';
        } else {
            $message = 'Something went wrong';
        }
        return response()->json([
            'message'       => $message,
        ]);
    }

    public function permanentDelete(Entitlement $entitlement)
    {
        if ($entitlement->trashed()) {
            $entitlement->resotre();
            return response()->json([
                'message'       => 'Entitlement Resotred'
            ]);
        }
    }

    public function restore(Entitlement $entitlement)
    {
        if ($entitlement->trashed()) {
            $entitlement->forceDelete();
            return response()->json([
                'message'       => 'Entitlement Permanently Removed'
            ]);
        }
    }
}
