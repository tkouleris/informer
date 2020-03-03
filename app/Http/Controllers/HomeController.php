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

        $response = $guzzleUtil->getRequest('sources?apiKey=21376581dce440f1b991ef81aadea207');
        dd($response);
        return view('home');
    }
}
