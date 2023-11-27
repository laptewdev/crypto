<?php

namespace App\Http\Controllers\api;

use App\Components\BinanceClient;
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

    public function bar_data()
    {
        $client = new CryptorankClient();
        $query_keys = [
            'limit' => 6,
            'sort' => '-price',
            'api_key' => '128b2bc56a9f211b422009b0d88dfa4de2cb0ea276c1490dec3560defd74',
        ];
        $responce = $client->client->request('GET', '', ['query' => $query_keys]);
        $responce = json_decode($responce->getBody()->getContents());

        $data = [
            'name' => [],
            'price' => []
        ];
        foreach ($responce->data as $mass) {
            array_push($data["name"], $mass->name);
            array_push($data["price"], round($mass->values->USD->price, 2));
        }
        $chartData = [
            "labels" => $data['name'],
            "datasets" => [
                [
                    "label" => "Top 6 price",
                    "backgroundColor" => "#f87979",
                    "data" => $data['price'],
                ]
            ]
        ];

        // chartData: {
        //     labels: [ 'January', 'February', 'March'],
        //     datasets: [
        //       {
        //         label: 'Data One',
        //         backgroundColor: '#f87979',
        //         data: [40, 20, 12]
        //       }
        //     ]
        //   }

        return $chartData;
    }

    public function home_data(Request $request)
    {

        $client = new CryptorankClient();
        $query_keys = [
            'limit' => $request->query('limit', 100),
            'sort' => $request->query('sort', '-price'),
            'api_key' => '128b2bc56a9f211b422009b0d88dfa4de2cb0ea276c1490dec3560defd74',
        ];

        if ($request->query('name') != null) $query_keys['symbols'] = $request->query('name');

        $responce = $client->client->request('GET', '', ['query' => $query_keys]);
        $responce = json_decode($responce->getBody()->getContents());

        $data = [];
        foreach ($responce->data as $mass) {
            array_push($data, [
                'id' => $mass->id,
                'name' => $mass->name,
                'price' => round($mass->values->USD->price, 2),
                'req_data' => $mass
            ]);
        }

        return $data;
    }
}
