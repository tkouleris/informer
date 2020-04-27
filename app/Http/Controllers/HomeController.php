<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ISettingRepository;
use App\Services\UserNewsService;
use App\Utils\GuzzleUtil;
use App\Utils\NewsEndpoints;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param UserNewsService $UserNewsService
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UserNewsService $UserNewsService)
    {
//        /*
//         *  TODO - UserNewsService
//         * -----------------------------
//         * It will get the news according the user settings
//         */
//
//        $responseGR = $guzzleUtil->getRequest(NewsEndpoints::$TOP_HEADER,"country=gr");
//        $responseUS = $guzzleUtil->getRequest(NewsEndpoints::$TOP_HEADER,"country=us");
//
//        $articles_array = array_merge($responseGR->articles, $responseUS->articles);
//        $articles = collect($articles_array);
//        $articles = $articles->sortByDesc('publishedAt');
        $articles = $UserNewsService->fetch(Auth::id());

        return view('home',compact('articles'));
    }
}
