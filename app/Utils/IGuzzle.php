<?php


namespace App\Utils;


interface IGuzzle
{
    public function getRequest($url, $options = null);
}
