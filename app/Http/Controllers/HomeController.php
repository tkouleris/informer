<?php

namespace App\Http\Controllers;

use App\Services\UserNewsService;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @param UserNewsService $UserNewsService
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, UserNewsService $UserNewsService)
    {
        $search_query = $request->input('search_query');
        $articles = $UserNewsService->fetch(Auth::id(),$search_query);
        return view('home',compact('articles','search_query'));
    }
}
