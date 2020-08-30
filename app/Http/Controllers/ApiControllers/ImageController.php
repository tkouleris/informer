<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Requests\ImageRequest;
use App\Services\ImageService;

class ImageController extends Controller
{
    protected $ImageService;

    /**
     * ImageController constructor.
     * @param ImageService $ImageService
     */
    public function __construct(ImageService $ImageService)
    {
        parent::__construct();
        $this->ImageService = $ImageService;
    }

    public function ImageUpload(ImageRequest $request)
    {
        $imageName = $this->ImageService->AvatarImageUpload($request, auth()->user()->id);
    }
}
