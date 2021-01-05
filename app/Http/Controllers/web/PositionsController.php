<?php

namespace App\Http\Controllers\web;

use App\Position;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->isAdmin() || Auth::user()->superuser) {
                return $next($request);
            } else {
                abort(401);
            }
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::paginate(15);

        return view('web.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pos = new Position();
        $pos->name = $request->name;
        $pos->mngr = isset($request->mngr);
        $pos->save();

        return redirect()
                    ->route('web.positions.edit', $pos)
                    ->with('status', [
                        'msg'   =>  'New Position Created!',
                        'variant'   =>  'success',
                    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('web.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $position->name = $request->name;
        $position->mngr = isset($request->mngr);
        $position->save();

        return redirect()
                    ->back()
                    ->with('status', [
                        'msg'   =>  'Position updated!',
                        'variant'   =>  'success',
                    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        if($position->delete()) {
            return redirect()
                        ->route('web.positions.index')
                        ->with('status', [
                            'msg'   => 'Position removed!',
                            'variant'   =>  'success',
                        ]);
        }
    }
}
