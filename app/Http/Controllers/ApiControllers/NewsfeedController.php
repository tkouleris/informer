<?php

namespace App\Http\Controllers\ApiControllers;

use App\Services\SettingsPageService;
use App\Services\UserNewsService;
use Illuminate\Http\Request;

class NewsfeedController extends Controller
{
    protected $userNewsService;
    protected $settingsPageService;
    protected $items_per_page = 5;

    /**
     * NewsfeedController constructor.
     * @param UserNewsService $userNewsService
     * @param SettingsPageService $settingsPageService
     */
    public function __construct(UserNewsService $userNewsService, SettingsPageService $settingsPageService)
    {
        parent::__construct();
        $this->userNewsService = $userNewsService;
        $this->settingsPageService = $settingsPageService;
    }


    public function feed(Request $request)
    {
        $user = auth()->user();
        $search_query = $request->input('search_query');
        $category_filter = $request->input('category');
        $articles = $this->userNewsService->fetch($user->id);
        $categories = $this->settingsPageService->fetch_active_categories($user->id);
        $page = 1;
        if( isset( $request->page ) )
        {
            $page = $request->page;
        }
        $total_pages = $articles->count()/$this->items_per_page;
        $articles = $articles->forPage($page,$this->items_per_page);
        return $articles;
    }
}
