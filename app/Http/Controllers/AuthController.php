<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        //$requestData['password'] = Hash::make($request->password);

        $user = User::create($requestData);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['user'=> $user,'access_token'=>$accessToken],200);

    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response()->json(['message' => 'Datos incorrectos'],400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accesToken;
        return response(['user' => auth()->user(), 'acces_token' => $accessToken]);
    }
}
