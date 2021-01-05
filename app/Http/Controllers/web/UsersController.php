<?php

namespace App\Http\Controllers\web;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(15);

        if($request->ajax()) {
            $users = User::select(['id','name','email','created_at','updated_at']);
            $dt = new Datatables();
            return $dt->of($users)
                        ->make(true);
        }

        return view('web.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.users.create');
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
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'type'      => 'required',
        ]);

        if (!$validate->fails()) {
            $user = new User();
            $user->fill($request->all());
            $user->save();

            return redirect()->route('web.users.edit', $user)
                                ->with('status', [
                                    'msg'   =>  'User Successfully Created.',
                                    'variant'   =>  'success',
                                ]);
        } else {
            return redirect()->back()
                                ->withErrors($validate->errors())
                                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('web.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validate = Validator::make($request->all(), [
                        'password'                  => 'confirmed',
                        'email'                     => 'email|unique:users,email,'.$user,
                    ]);

        if(!$validate->fails())
        {
            $user->fill($request->all());
            $user->password = bcrypt($request->password);
            $user->superuser = isset($request->superuser);
            $user->save();

            return redirect()->route('web.users.edit', $user)
                                ->with('status', [
                                    'msg'   =>  'User Updated.',
                                    'variant'   =>  'success',
                                ]);
        } else {
            return redirect()->back()
                                ->withErrors($validate->errors())
                                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete())
        {
            return redirect()->route('web.users.index')
                                ->with('status', [
                                    'msg'   =>  'User removed.',
                                    'variant'   =>  'success',
                                ]);
        }
    }
}
