<?php

namespace App\Components;

use GuzzleHttp\Client;

class CryptorankClient
{
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.cryptorank.io/v1/currencies/',
            'timeout' => 2.0,
            'query' => [
                'api_key' => '128b2bc56a9f211b422009b0d88dfa4de2cb0ea276c1490dec3560defd74',
            ],
        ]);
    }
}
