<?php

namespace App\Http\Controllers;

use App\Services\SettingsPageService;
use App\Services\UserNewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsfeedController extends Controller
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
     * @param SettingsPageService $SettingsPageService
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, UserNewsService $UserNewsService, SettingsPageService $SettingsPageService)
    {
        $UserID = Auth::id();
        $search_query = $request->input('search_query');
        $articles = $UserNewsService->fetch($UserID,$search_query);
        $categories = $SettingsPageService->fetch_active_categories($UserID);
        return view('newsfeed',compact('articles','categories','search_query'));
    }
}
