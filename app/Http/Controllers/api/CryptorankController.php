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
        $responce = $client->client->request('GET', '');
        $responce = json_decode($responce->getBody()->getContents());
        $data = [
            'res' => $responce
        ];
        return $data;
    }
}
