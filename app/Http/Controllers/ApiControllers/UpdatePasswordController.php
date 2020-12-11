<?php

namespace App\Http\Controllers\ApiControllers;

use App\Exceptions\UserException;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \App\Exceptions\UserException
     */
    public function update(Request $request)
    {
        try {
            $this->UserService->update_password(Auth::id(), $request->new_password, $request->password_confirm);
        } catch (UserException $e) {
            return response($e->getMessage(),400);
        }
        return response('Password Changed',200);
    }
}
