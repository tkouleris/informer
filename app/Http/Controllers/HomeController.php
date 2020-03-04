<?php

namespace App\Http\Controllers;

use App\Utils\GuzzleUtil;
use App\Utils\NewsEndpoints;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

        $response = $guzzleUtil->getRequest(NewsEndpoints::$TOP_HEADER,"country=gr");
        $articles = $response->articles;
        return view('home',compact('articles'));
    }
}
