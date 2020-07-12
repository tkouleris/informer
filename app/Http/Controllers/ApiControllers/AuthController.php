<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\ApiControllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email','password']);
        if( !$token = auth()->attempt($credentials) ){
            return response()->json(['error'=> 'Bad Credentials'],401);
        }
        return response()->json(['token'=>$token]);
    }
}
