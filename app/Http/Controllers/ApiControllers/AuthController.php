<?php

namespace App\Http\Controllers\ApiControllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email','password']);

        if( !$token = auth()->attempt($credentials) ){
            return response()->json(['error'=> 'Bad Credentials'],401);
        }
        $user = User::where('email',$credentials['email'])->first();

        return response()->json(
            [
                'id'=>$user->id,
                'name'=>$user->name,
                'token'=>$token
            ]
        );
    }
}
