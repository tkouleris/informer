<?php


namespace App\Utils;


use GuzzleHttp\Client;

class GuzzleUtil
{
    protected $client;
    protected $api_key;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://newsapi.org/v2/']);
        $this->api_key = config('app.news_api_key');
    }


    public function getRequest($url)
    {
        $response = $this->client->request('GET', $url);
        return json_decode($response->getBody());
    }

}
