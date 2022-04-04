<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $requestData['password'] = Hash::make($request->password);

        $user = User::create($requestData);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['user'=> $user,'access_token'=>$accessToken],200);

    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);



        if(!Auth::login($loginData)){
            //return $loginData;
            return response()->json(['message' => 'Datos incorrectos'],400);
        }
        else{   
            $user = Auth::user(); 
            //$loginToken = $user->createToken('authToken')->loginToken;
            //return response()->json(['acces_token' => $loginToken]);
            return $user;
        }  


        /*         if(auth()->attempt($loginData)){
            //generate the token for the user
            $user_login_token= auth()->user()->createToken('authToken')->accessToken;
            //now return this token on success login attempt
            return response()->json(['token' => $user_login_token], 200);
        }
        else{
            //wrong login credentials, return, user not authorised to our system, return error code 401
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }  */


    }
    
}
