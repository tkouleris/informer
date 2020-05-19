<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function ImageUpload()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $UserID = Auth::id();
        $imageName = "avatar.".request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/'.$UserID), $imageName);

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }
}
