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

    public function settingsPage(ICountryRepository $CountryRepository, ICategoryRepository $CategoryRepository)
    {


        return view('settings',compact('countries','categories'));
    }
}
