<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('employee_info')->get();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()) {
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
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'type'      => 'required',
        ]);
        
        if (!$validate->fails()) {
            $user = new User;
            $user->fill([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'type'      => $request->type
            ]);

            $user->save();

            return response()->json([
                'message'       => 'User Created',
                'result'        => $user,
            ]);
        } else {
            return response()->json(['errors' => $validate->errors()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'user'              => $user,
            'info'              => $user->employee_info,
            'uploaded'          => $user->uploaded_files,
            'modified'          => $user->modified_files,
            'announcements'     => $user->announcement,
            'approved_leave'    => $user->approvedLeave,
            'isAdmin'           => $user->isAdmin(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(request()->ajax()) {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validate = Validator::make($request->all(), [
            'name'                      => 'required',
            'password'                  => 'confirmed',
            'password_confirmation'     => 'required_with:password'
        ]);
        
        if (!$validate->fails()) {
            $user->fill([
                'name'      => $request->name,
                'type'      => $request->type,
            ]);

            if(isset($request->employee_id)) {
                $user->employee_id = $request->employee_id;
            }

            if(isset($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return response()->json([
                'message'       => 'User Updated',
                'result'        => $user,
            ]);
        } else {
            return response()->json(['errors' => $validate->errors()]);
        }
    }

    public function verifyUser(User $user)
    {
        $user->verified = \Carbon\Carbon::now();
        $user->save();

        return response()->json([
            'message' => 'Verified user'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            $message = 'User has been removed';
        } else {
            $message = 'Something went wrong';
        }
            return response()->json([
                'message'       => $message,
            ]);
    }

    public function restore(User $user)
    {
        if ($user->trashed()) {
            $user->resotre();
            return response()->json([
                'message'       => 'User Resotred'
            ]);
        }
    }

    public function deletePermanent(User $user)
    {
        if ($user->trashed()) {
            $user->forceDelete();
            return response()->json([
                'message'       => 'User Permanently Removed'
            ]);
        }
    }
}
