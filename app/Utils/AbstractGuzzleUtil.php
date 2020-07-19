<?php


namespace App\Utils;


abstract class AbstractGuzzleUtil
{
    protected $api_key;

    protected function get_full_url($url,$options)
    {
        $full_url = $url."?apiKey=".$this->api_key;
        if($options != null)
        {
            $full_url .= "&".$options;
        }
        return $full_url;
    }

}
