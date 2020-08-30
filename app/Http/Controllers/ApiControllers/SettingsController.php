<?php

namespace App\Http\Controllers\ApiControllers;

use App\DTO\SettingsPageData;
use App\Services\SettingsPageService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $SettingsPageService;
    protected $SettingsPageData;

    /**
     * Create a new controller instance.
     *
     * @param SettingsPageService $SettingsPageService
     * @param SettingsPageData $SettingsPageData
     */
    public function __construct(SettingsPageService $SettingsPageService, SettingsPageData $SettingsPageData)
    {
        $this->SettingsPageService = $SettingsPageService;
        $this->SettingsPageData = $SettingsPageData;
    }

    public function settingsPage()
    {
        return response()->json($this->SettingsPageService->fetch_all());
    }

    public function country_categories($country_id)
    {
        $logged_in_user = auth()->user()->id;
        return $this->SettingsPageService->fetch_country_categories($country_id,$logged_in_user);
    }

    public function set_category_for_country(Request $request)
    {
        $country_id = $request->input('country_id');
        $category_id  = $request->input('category_id');
        $user_id = auth()->user()->id;

        $this->SettingsPageService->set_category_for_country($user_id,$country_id,$category_id);
    }
}
