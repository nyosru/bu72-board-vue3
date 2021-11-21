<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VitrinController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('{method}/{var1}', [VitrinController::class, 'api'])
    ->where('method', '.*')
    ->where('var1', '.*');
Route::get('{method}', [VitrinController::class, 'api'])
    ->where('method', '.*');
Route::post('{method}', [VitrinController::class, 'apiPost'])
    ->where('method', '.*');
