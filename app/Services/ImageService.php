<?php


namespace App\Services;

use App\Http\Requests\ImageRequest;

class ImageService
{
    public function AvatarImageUpload(ImageRequest $request, $UserID)
    {
        $imageName = "avatar.".$request->image->getClientOriginalExtension();
        $request->image->move(public_path(config('app.avatar_folder').$UserID), $imageName);
        return $imageName;
    }
}
