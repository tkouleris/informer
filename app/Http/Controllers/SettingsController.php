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
        $settings = $this->SettingsPageService->fetch_all();
        return view('settings',compact('settings'));
    }

    public function country_categories($country_id)
    {
        $logged_in_user = Auth::id();
        return $this->SettingsPageService->fetch_country_categories($country_id,$logged_in_user);
    }

    public function set_category_for_country(Request $request)
    {
        $country_id = $request->input('country_id');
        $category_id  = $request->input('category_id');
        $user_id = Auth::id();

        $this->SettingsPageService->set_category_for_country($user_id,$country_id,$category_id);

    }
}
