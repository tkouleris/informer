<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://newsapi.org/v2/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', 'top-headlines?country=us&apiKey='.config('app.news_api_key'));
        $response = json_decode($response->getBody());
        dd($response);

        return view('home');
    }
}
