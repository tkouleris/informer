<?php

namespace App\Http\Controllers\ApiControllers;

use App\Services\UserNewsService;
use Illuminate\Http\Request;

class NewsfeedController extends Controller
{
    protected $userNewsService;

    /**
     * NewsfeedController constructor.
     * @param $userNewsService
     */
    public function __construct(UserNewsService $userNewsService)
    {
        $this->userNewsService = $userNewsService;
    }


    public function feed()
    {
        $user = auth()->user();
        return $this->userNewsService->fetch($user->id);
    }
}
