<?php

namespace App\Http\Controllers\web;

use App\User;
use App\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class NotifcationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Auth::user()->notifications;
        return view('web.notifications.index', compact('notifications'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($notification = Auth::user()->notifications()->find($id)) {
            $notification->markAsRead();
            $leaves = Leave::where('id', $notification->data['leave']['id'])->paginate(5);
            if($notification->type == 'App\Notifications\LeaveStatusUpdate') {
                $requests = $leaves;
                return view('web.profile.requests', compact('requests'));
            } else {
                return view('web.leave.index', compact('leaves'));
            }
        }
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

    public function markallasread()
    {
        dd('test');
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
