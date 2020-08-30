<?php

namespace App\Http\Controllers\ApiControllers;

use App\DTO\SettingsPageData;
use App\Services\SettingsPageService;
use App\Http\Controllers\Controller;

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
}
