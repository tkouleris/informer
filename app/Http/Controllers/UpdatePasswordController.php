<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    protected $UserService;

    /**
     * UpdatePasswordController constructor.
     * @param $UserService
     */
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }


    /**
     * Update the password for the user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\UserException
     */
    public function update(Request $request)
    {
        try {
            $this->UserService->update_password(Auth::id(), $request->new_password, $request->password_confirm);
        } catch (UserException $e) {
            return back()->withErrors(['confirm_password'=>'Password not match']);
        }
        return back();
    }
}
