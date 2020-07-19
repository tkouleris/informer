<?php


namespace App\Utils;


use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CachedGuzzleUtil implements IGuzzle
{
    protected $guzzleUtil;

    /**
     * CachedGuzzleUtil constructor.
     * @param $guzzleUtil
     */
    public function __construct(GuzzleUtil $guzzleUtil)
    {
        $this->guzzleUtil = $guzzleUtil;
    }

    public function getRequest($url, $options = null)
    {
        $guzzle = $this->guzzleUtil;
        return Cache::remember($options,Carbon::now()->addHours(1),function () use($guzzle, $url, $options){
            $guzzle->getRequest($url,$options);
        });
    }
}
