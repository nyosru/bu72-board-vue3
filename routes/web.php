<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UloginController;
use App\Http\Controllers\VitrinController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/







// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::post('/api-chat/add_msg', [ChatController::class, 'api_chat__add_msg']);

Route::get('/api-chat/{room_id}/{writer_id}', [ChatController::class, 'api_chat__get_chat']);
Route::get('/api-chat/list_users/{room_id}', [ChatController::class, 'api_chat__get_chat_list_users']);







// Auth::routes();
Route::post('ulogin1', [UloginController::class, 'login']);
Route::get('logout', function () {
    // return 'Hello World';
    Auth::logout();
    return redirect()->route('index');
});

Route::prefix('vitrin')->group(function () {
    Route::get('/', [VitrinController::class, 'index']);
});

// Route::prefix('api')->group(
//     function () {
//         Route::get('{method}/{var1}', [VitrinController::class, 'api'])
//             ->where('method', '.*')
//             ->where('var1', '.*');
//         Route::get('{method}', [VitrinController::class, 'api'])
//             ->where('method', '.*');
//         Route::post('{method}', [VitrinController::class, 'apiPost'])
//             ->where('method', '.*');
//     }
// );

// если ничего не сработало идём на старт
Route::get('/', [VitrinController::class, 'index'])->name('index');

Route::get('{any?}', [VitrinController::class, 'index'])
    ->where('any', '.*');
