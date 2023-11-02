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
        ]);
    }
}
