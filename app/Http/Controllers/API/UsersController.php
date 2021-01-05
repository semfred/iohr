<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UsersController extends Controller
{
public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $creds = [
            'email'     =>  $request->email,
            'password'  =>  $request->password,
        ];
        // $pass = bcrypt(request('password'));
        if(auth()->attempt($creds)){
            $user = Auth::user();
            return response()->json(['token' => $user->createToken('_intelligent_hr_token_login')->accessToken, 'user' => $user, 'status' => $this->successStatus]);
            // return response()->json(['user' => $user, 'status' => $this->successStatus]);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

        // if($user = User::where('email', request('email'))->first()) {
        //     Auth::login($user);
        //     return response()->json(['user' => $user, 'status' => $this->successStatus]);
        // } else {
        //     return response()->json(['error' => 'no user found'], 401);
        // }

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message'       => 'Successfully Logged Out',
        ]);
    }
}
