<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    /**
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the new password length...
        $new_password = $request->new_password;
        $password_confirm = $request->password_confirm;

        if($new_password !== $password_confirm)
        {
            return back()->withErrors(['confirm_password'=>'Password not match']);
        }
        $user = Auth::user();
        $user->password = Hash::make($new_password);
        $user->save();

        return back();
    }
}
