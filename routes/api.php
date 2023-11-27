<?php

use App\Http\Controllers\api\CryptorankController;
use App\Http\Controllers\api\BinanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resources([
//     'cryptorank' => [CryptorankController::class, 'index'],
// ]);

Route::get('home_data', [BinanceController::class, 'home_data']);
Route::get('home_chart_data', [BinanceController::class, 'home_chart_data']);
Route::get('main_page_data', [BinanceController::class, 'index']);
Route::get('main_page_bar_data', [BinanceController::class, 'main_page_bar_data']);
