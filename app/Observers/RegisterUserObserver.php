<?php


namespace App\Observers;


use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICountryRepository;
use App\Repositories\Interfaces\ISettingRepository;
use App\User;
use Exception;
use Illuminate\Support\Facades\Log;

class RegisterUserObserver
{
    private $categoryRepository;
    private $countryRepository;
    private $settingRepository;
    private $default_country = 'us';

    /**
     * RegisterUserObserver constructor.
     * @param ICategoryRepository $categoryRepository
     * @param ICountryRepository $countryRepository
     * @param ISettingRepository $settingRepository
     */
    public function __construct(
        ICategoryRepository $categoryRepository,
        ICountryRepository $countryRepository,
        ISettingRepository $settingRepository
    ){
        $this->categoryRepository = $categoryRepository;
        $this->countryRepository = $countryRepository;
        $this->settingRepository = $settingRepository;
    }


    public function created(User $registeredUser)
    {
        $registered_userid = $registeredUser->id;
        $countries = $this->countryRepository->all();
        $categories = $this->categoryRepository->all();

        foreach ($countries as $country)
        {
            $country_id = $country->CountryID;
            $country_short_name = $country->CountryShortName;
            foreach ($categories as $category)
            {
                $insert_settings_data = [];
                $insert_settings_data['setting_userid'] = $registered_userid;
                $insert_settings_data['setting_categoryid'] = $category->CategoryID;
                $insert_settings_data['setting_countryid'] = $country_id;
                $insert_settings_data['setting_active'] = ($country_short_name == $this->default_country)?true:false;
                $this->settingRepository->create($insert_settings_data);
            }
        }
    }
}
