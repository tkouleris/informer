<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    protected $ImageService;

    public function __construct(ImageService $ImageService)
    {
        $this->ImageService = $ImageService;
    }

    public function ImageUpload(ImageRequest $request)
    {
        $imageName = $this->ImageService->AvatarImageUpload($request, Auth::id());
        return back();
    }
}
