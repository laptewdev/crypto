<?php

namespace App\Http\Controllers\api;

use App\Components\BinanceClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Http\Request;

class BinanceController extends Controller
{
    public function index()
    {
        $data = [];
        $client = new BinanceClient();

        $responce = $client->client->request('GET', 'v3/ticker/price');
        $responce = json_decode($responce->getBody()->getContents());

        foreach ($responce as $item) {
            if (str_contains($item->symbol, 'USDT')) {
                array_push($data, [
                    'name' => $item->symbol,
                    'price' => round($item->price, 2),
                ]);
            }
        }
        usort($data, function ($a, $b) {
            if ($a["price"] == $b["price"]) {
                return 0;
            }
            return ($a["price"] < $b["price"]) ? 1 : -1;
        });

        return [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5]];
    }

    public function main_page_bar_data()
    {
        $data = [];
        $chartData = [
            'name' => [],
            'price' => []
        ];

        $client = new BinanceClient();

        $responce = $client->client->request('GET', 'v3/ticker/price');
        $responce = json_decode($responce->getBody()->getContents());

        foreach ($responce as $item) {
            if (str_contains($item->symbol, 'USDT')) {
                array_push($data, [
                    'name' => $item->symbol,
                    'price' => round($item->price, 2),
                ]);
            }
        }
        usort($data, function ($a, $b) {
            if ($a["price"] == $b["price"]) {
                return 0;
            }
            return ($a["price"] < $b["price"]) ? 1 : -1;
        });

        for ($i = 0; $i < 6; $i++) {
            array_push($chartData['name'], $data[$i]['name']);
            array_push($chartData['price'], $data[$i]['price']);
        }

        $barChartData = [
            "labels" => $chartData['name'],
            "datasets" => [
                [
                    "label" => "Top 6 price",
                    "backgroundColor" => "#f87979",
                    "data" => $chartData['price'],
                ]
            ]
        ];

        return $barChartData;
    }

    public function home_data(Request $request)
    {
        $data = [];
        $client = new BinanceClient();
        $sort_name = '';

        $responce = $client->client->request('GET', 'v3/ticker/price');
        $responce = json_decode($responce->getBody()->getContents());

        if ($request->query('name') != null) $sort_name = $request->query('name');

        foreach ($responce as $item) {
            if (str_contains($item->symbol, $sort_name)) {
                array_push($data, [
                    'name' => $item->symbol,
                    'price' => round($item->price, 2),
                ]);
            }
        }
        usort($data, function ($a, $b) {
            if ($a["price"] == $b["price"]) {
                return 0;
            }
            return ($a["price"] < $b["price"]) ? 1 : -1;
        });

        return $data;
    }

    public function home_chart_data(Request $request)
    {
        $data = [
            'time' => [],
            'price' => [],
        ];
        $chartData = [];
        $client = new BinanceClient();
        $query_keys = [
            'interval' => $request->query('interval'),
            'startTime' => Carbon::parse($request->query('start_time'))->getPreciseTimestamp(3),
            'endTime' => Carbon::parse($request->query('end_time'))->getPreciseTimestamp(3),
        ];

        if ($request->query('symbol') != null) $query_keys['symbol'] = $request->query('symbol');


        try {
            $responce = $client->client->request('GET', 'v3/klines', ['query' => $query_keys]);
            $responce = json_decode($responce->getBody()->getContents());

            foreach ($responce as $item) {
                $date = date("d/m/Y H:i:s", $item[0] / 1000);
                array_push($data['time'], (string)$date);
                array_push($data['price'], round($item[1], 2));
            }

            $chartData = [
                "data" => [
                    "labels" => $data['time'],
                    "datasets" => [
                        [
                            "label" => $request->query('symbol'),
                            "tencion" => 0.1,
                            "borderColor" => "#ffffff",
                            "pointHoverBackgroundColor" => '#7cfaa2',
                            "borderWidth" => 1,
                            "pointHoverBorderColor" => '#7cfaa27a',
                            "pointStyle" => 'circle',
                            "data" => $data['price'],
                        ]
                    ],
                ],
                "options" => [
                    "responsive" => true,
                    "maintainAspectRatio" => false,
                    "legend" => [
                        "position" => 'top',
                    ],
                    "scales" => [
                        "y" => [
                            "min" => "original",
                            "max" => "original",
                        ],
                    ],
                    "plugins" => [
                        "zoom" => [
                            "limits" => [
                                "y" => ["min" => "original", "max" => "original"],
                            ],
                            "pan" => [
                                "enabled" => true
                            ],
                            "zoom" => [
                                "wheel" => [
                                    "enabled" => true,
                                ],
                                "pinch" => [
                                    "enabled" => true
                                ],
                                "drag" => [
                                    "enabled" => false
                                ],
                                "mode" => 'xy',
                            ],
                        ]
                    ],
                ],
            ];
        } catch (Exception $e) {
            $chartData = [
                "data" => [
                    "labels" => "",
                    "datasets" => [
                        [
                            "label" => $request->query('symbol') . " search...",
                            "tencion" => 0.1,
                            "borderColor" => "#ffffff",
                            "pointHoverBackgroundColor" => '#7cfaa2',
                            "borderWidth" => 1,
                            "pointHoverBorderColor" => '#7cfaa27a',
                            "pointStyle" => 'circle',
                            "data" => "",
                        ]
                    ]
                ],
                "options" => [
                    "responsive" => true,
                    "maintainAspectRatio" => false,
                    "legend" => [
                        "position" => 'top',
                    ],
                    "plugins" => [
                        "zoom" => [
                            "limits" => [
                                "y" => ["min" => 'original', "max" => 'original'],
                            ],
                            "pan" => [
                                "enabled" => true
                            ],
                            "zoom" => [
                                "wheel" => [
                                    "enabled" => true,
                                ],
                                "pinch" => [
                                    "enabled" => true
                                ],
                                "drag" => [
                                    "enabled" => false
                                ],
                                "mode" => 'xy',
                            ],
                        ]
                    ],
                ],
            ];
        }

        return $chartData;
    }
}
