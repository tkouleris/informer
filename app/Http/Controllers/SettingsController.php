<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICountryRepository;
use App\Services\SettingsPageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    protected $SettingsPageService;
    /**
     * Create a new controller instance.
     *
     * @param SettingsPageService $SettingsPageService
     */
    public function __construct(SettingsPageService $SettingsPageService)
    {
        $this->middleware('auth');
        $this->SettingsPageService = $SettingsPageService;
    }

    public function settingsPage(ICountryRepository $CountryRepository, ICategoryRepository $CategoryRepository)
    {
        $settings = $this->SettingsPageService->fetch();
        return view('settings',compact('settings'));
    }
}
