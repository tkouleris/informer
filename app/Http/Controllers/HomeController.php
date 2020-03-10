<?php

namespace App\Http\Controllers;

use App\Utils\GuzzleUtil;
use App\Utils\NewsEndpoints;

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
     * @param GuzzleUtil $guzzleUtil
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(GuzzleUtil $guzzleUtil)
    {

        $responseGR = $guzzleUtil->getRequest(NewsEndpoints::$TOP_HEADER,"country=gr");
        $responseUS = $guzzleUtil->getRequest(NewsEndpoints::$TOP_HEADER,"country=us");

        $articles_array = array_merge($responseGR->articles, $responseUS->articles);
        $articles = collect($articles_array);
        $articles = $articles->sortByDesc('publishedAt');
        return view('home',compact('articles'));
    }
}
