<?php


namespace App\Utils;


use GuzzleHttp\Client;

class GuzzleUtil extends AbstractGuzzleUtil implements IGuzzle
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://newsapi.org/v2/']);
        $this->api_key = config('app.news_api_key');
    }

    public function getRequest($url, $options = null)
    {
        $full_url = $this->get_full_url($url,$options);
        $response = $this->client->request('GET', $full_url);
        return json_decode($response->getBody());
    }
}
