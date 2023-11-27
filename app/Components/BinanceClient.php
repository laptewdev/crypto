<?php

namespace App\Components;

use GuzzleHttp\Client;

class BinanceClient
{
    public $client;

    public function __construct()
    {
        $api_key = 'YlXGbFLAHvKcD0bB6XkZl2kCVL40kRIq3MNoeUCqn1ENOqokYlimNA7v4nxZOX9F';
        $api_secret = 'jOpLT8plfmb22eVjADXBGOtsE2mkquDebBU4sVPmZ82rhO6kM38T0zr90dqr67vD';
        $header_keys = [
            'X-MBX-APIKEY' => $api_key,
        ];
        $this->client = new Client([
            'base_uri' => 'https://testnet.binance.vision/api/',
        ]);
    }
}

        // $api_key = 'YlXGbFLAHvKcD0bB6XkZl2kCVL40kRIq3MNoeUCqn1ENOqokYlimNA7v4nxZOX9F';
        // $api_secret = 'jOpLT8plfmb22eVjADXBGOtsE2mkquDebBU4sVPmZ82rhO6kM38T0zr90dqr67vD';
        // $timestamp = time() * 1000;
        // $signature = hash_hmac('SHA256', "timestamp=" . $timestamp, $api_secret);

        // $query_keys = [
        //     // 'timestamp' => $timestamp, //for autorithation
        //     // 'signature' => $signature, //for autorithation
        //     // 'symbol' => 'BTCUSDT',
        //     // 'interval' => '1m'
        // ];
        // $header_keys = [
        //     'X-MBX-APIKEY' => $api_key,
        // ];