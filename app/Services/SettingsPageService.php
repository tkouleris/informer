<?php


namespace App\Services;


use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICountryRepository;

class SettingsPageService
{
    protected $CountryRepository;
    protected $CategoryRepository;

    public function __construct(ICountryRepository $CountryRepository, ICategoryRepository $CategoryRepository)
    {
        $this->CountryRepository = $CountryRepository;
        $this->CategoryRepository = $CategoryRepository;
    }

    public function fetch()
    {
        $countries = $this->CountryRepository->all();
        $categories = $this->CategoryRepository->all();
    }
}
