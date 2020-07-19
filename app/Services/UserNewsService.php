<?php


namespace App\Services;


use App\Repositories\Interfaces\ISettingRepository;
use App\Utils\GuzzleUtil;
use App\Utils\IGuzzle;
use App\Utils\NewsEndpoints;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

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
    public function __construct(ISettingRepository $UserSettingsRepository, IGuzzle $guzzleUtil)
    {
        $this->UserSettingsRepository = $UserSettingsRepository;
        $this->guzzleUtil = $guzzleUtil;
    }

    public function fetch($UserID, $search_query = "", $category_filter = null)
    {
        $SettingsCollection = $this->UserSettingsRepository->find_active_by_user($UserID);

        foreach ($SettingsCollection as $setting)
        {
            $options = "";
            $options .= "country=".$setting->CountryShortName;
            $options .= "&category=".$setting->CategoryShort;
            if($search_query != "") $options .= "&q=".$search_query;
            $guzzle = $this->guzzleUtil;
            $top_headers = NewsEndpoints::$TOP_HEADER;
//            $NewsApiResponse = cache()->remember($options,Carbon::now()->addHours(1),function () use($guzzle, $top_headers, $options){
//                $guzzle->getRequest($top_headers,$options);
//            });
            $NewsApiResponse = $this->guzzleUtil->getRequest(NewsEndpoints::$TOP_HEADER,$options);
            $NewsArticles = $this->add_category($NewsApiResponse->articles,$setting->CategoryShort);
            $this->articles_array = array_merge($this->articles_array, $NewsArticles);
        }

        $articles = collect($this->articles_array);
        $articles = $articles->sortByDesc('publishedAt');

        return $articles->filter(function ($article) use ($category_filter){
            if($category_filter == null) return $article;
            if( $category_filter == $article->category ) return $article;
        });
    }


    private function add_category($articles, $category_short_description)
    {
        foreach ($articles as $item) {
            $item->category = $category_short_description;
        }
        return $articles;
    }
}
