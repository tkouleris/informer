<?php


namespace App\Services;


use App\DTO\SettingsPageData;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICountryRepository;
use App\Repositories\Interfaces\ISettingRepository;

class SettingsPageService
{
    protected $SettingRepository;
    protected $CountryRepository;
    protected $CategoryRepository;
    protected $SettingsPageData;

    public function __construct(
        ISettingRepository $SettingRepository,
        ICountryRepository $CountryRepository,
        ICategoryRepository $CategoryRepository,
        SettingsPageData $SettingsPageData
    )
    {
        $this->SettingRepository = $SettingRepository;
        $this->CountryRepository = $CountryRepository;
        $this->CategoryRepository = $CategoryRepository;
        $this->SettingsPageData = $SettingsPageData;
    }

    public function fetch_all():SettingsPageData
    {
        $this->SettingsPageData->Countries = $this->CountryRepository->all();
        $this->SettingsPageData->Categories = $this->CategoryRepository->all();
        return $this->SettingsPageData;
    }

    public function fetch_country_categories($country_id, $logged_in_user)
    {
        return $this->SettingRepository->find_by_countryID_and_userID($country_id,$logged_in_user);
    }

    public function set_category_for_country($user_id, $country_id,$category_id)
    {
        $setting = $this->SettingRepository->find_by_userID_countryID_categoryID($user_id,$country_id,$category_id);
        $data = [
            'setting_id' => $setting->setting_id,
            'setting_active' => ($setting->setting_active == true)?false:true
        ];
        $this->SettingRepository->update($data);
    }
}
