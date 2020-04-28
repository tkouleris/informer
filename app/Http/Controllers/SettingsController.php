<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICountryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
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

    public function index(ICountryRepository $CountryRepository, ICategoryRepository $CategoryRepository)
    {
//        $SettingsCollection = $this->UserSettingsRepository->find_active_by_user(Auth::id());
        $countries = $CountryRepository->all();
        $categories = $CategoryRepository->all();
        return view('settings',compact('countries','categories'));
    }
}
