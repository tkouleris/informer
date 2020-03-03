<?php


namespace App\Utils;


use GuzzleHttp\Client;

class GuzzleUtil
{
    protected $client;
    protected $api_key;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->api_key = config('app.news_api_key');
    }

    public function setBaseUrl($baseUrl)
    {
        $this->client->setDefaultOption('base_uri',$baseUrl);
    }

    public function getRequest($url)
    {
        $response = $this->client->request('GET', $url."&apiKey=".$this->api_key);
        return json_decode($response->getBody());
    }

}
