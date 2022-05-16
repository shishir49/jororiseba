<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;

class Authentication extends Controller
{
    public function registration(Request $request) {
        $validation = Validator::make($request->all(),[
            'name'             => 'required',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:8',
            'confirm_password' => 'required|required_with:password|same:password'
        ]);

        if(!$validation->fails()) {
            $create_user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password)
            ]);
            if($create_user) {
                return response()->json('success',200);
            }
        }else{
           return response()->json(['error' => $validation->errors()],401);
        }
    }

    public function login(Request $request) {
        $validation = Validator::make($request->all(),[
            'email'            => 'required|email',
            'password'         => 'required',
            'device_name'      => 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessage([
                'email' => ['Provided Credentials are Incorrect'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
        
    }

    public function userInfo(Request $request, $id) {
        $user_info = User::where('id', $id)->first();
        return response()->json(['user_info'=> $user_info],200);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout Successful'],200);
    }
}
