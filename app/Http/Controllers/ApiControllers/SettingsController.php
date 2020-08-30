<?php

namespace App\Http\Controllers\ApiControllers;

use App\DTO\SettingsPageData;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICountryRepository;
use App\Services\SettingsPageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SettingsController extends Controller
{
    protected $SettingsPageService;
    protected $SettingsPageData;
    /**
     * Create a new controller instance.
     *
     * @param SettingsPageService $SettingsPageService
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
}
