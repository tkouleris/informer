<?php


namespace App\Utils;


use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CachedGuzzleUtil implements IGuzzle
{
    protected $guzzleUtil;
    protected $api_key;
    /**
     * CachedGuzzleUtil constructor.
     * @param $guzzleUtil
     */
    public function __construct(GuzzleUtil $guzzleUtil)
    {
        $this->guzzleUtil = $guzzleUtil;
        $this->api_key = config('app.news_api_key');
    }

    public function getRequest($url, $options = null)
    {
        $guzzle = $this->guzzleUtil;
        $full_url = $url."?apiKey=".$this->api_key;
        if($options != null)
        {
            $full_url .= "&".$options;
        }
        return Cache::remember($full_url,Carbon::now()->addHours(1),function () use($guzzle, $url, $options){
            return $guzzle->getRequest($url,$options);
        });
    }
}
