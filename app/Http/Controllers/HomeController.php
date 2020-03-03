<?php

namespace App\Http\Controllers;

use App\Utils\GuzzleUtil;
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

        $guzzleUtil->setBaseUrl('http://newsapi.org/v2/');
//        dd($guzzleUtil->getRequest('top-headlines?country=us'));
        return view('home');
    }
}
