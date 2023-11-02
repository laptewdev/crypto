<?php

namespace App\Http\Controllers\api;

use App\Components\CryptorankClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CryptorankController extends Controller
{
    public function index()
    {
        $client = new CryptorankClient();
        $query_keys = [
            'limit' => 6,
            'sort' => '-price',
            'api_key' => '128b2bc56a9f211b422009b0d88dfa4de2cb0ea276c1490dec3560defd74',
        ];
        $responce = $client->client->request('GET', '', ['query' => $query_keys]);
        $responce = json_decode($responce->getBody()->getContents());

        $data = [];
        foreach ($responce->data as $mass) {
            array_push($data, [
                'name' => $mass->name,
                'price' => round($mass->values->USD->price, 2),
            ]);
        }

        return $data;
    }
}
