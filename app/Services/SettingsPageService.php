<?php


namespace App\Services;


use App\DTO\SettingsPageData;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICountryRepository;

class SettingsPageService
{
    protected $CountryRepository;
    protected $CategoryRepository;
    protected $SettingsPageData;

    public function __construct(ICountryRepository $CountryRepository, ICategoryRepository $CategoryRepository,SettingsPageData $SettingsPageData)
    {
        $this->CountryRepository = $CountryRepository;
        $this->CategoryRepository = $CategoryRepository;
        $this->SettingsPageData = $SettingsPageData;
    }

    public function fetch():SettingsPageData
    {
        $this->SettingsPageData->Countries = $this->CountryRepository->all();
        $this->SettingsPageData->Categories = $this->CategoryRepository->all();
        return $this->SettingsPageData;
    }
}
