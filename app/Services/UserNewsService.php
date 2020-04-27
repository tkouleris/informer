<?php


namespace App\Services;


use App\Repositories\Interfaces\ISettingRepository;
use App\Utils\GuzzleUtil;
use App\Utils\NewsEndpoints;

class UserNewsService
{
    protected $UserSettingsRepository;
    protected $guzzleUtil;
    protected $articles_array = [];

    /**
     * UserNewsService constructor.
     * @param ISettingRepository $UserSettingsRepository
     * @param GuzzleUtil $guzzleUtil
     */
    public function __construct(ISettingRepository $UserSettingsRepository, GuzzleUtil $guzzleUtil)
    {
        $this->UserSettingsRepository = $UserSettingsRepository;
        $this->guzzleUtil = $guzzleUtil;
    }

    public function fetch($UserID)
    {
        $SettingsCollection = $this->UserSettingsRepository->find_active_by_user($UserID);

        foreach ($SettingsCollection as $setting)
        {
            $options = "";
            $options .= "country=".$setting->CountryShortName;
            $options .= "&category=".$setting->CategoryShort;
            $NewsApiResponse = $this->guzzleUtil->getRequest(NewsEndpoints::$TOP_HEADER,$options);
            $this->articles_array = array_merge($this->articles_array, $NewsApiResponse->articles);
        }

        $articles = collect($this->articles_array);
        $articles = $articles->sortByDesc('publishedAt');

        return $articles;
    }
}
