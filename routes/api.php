<?php

use App\Events\MessageEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('teste', function () {
    \Log::debug([
        'REDIS_HOST' => env('REDIS_HOST'),
        'PUSHER_HOST' => env('PUSHER_HOST'),
        'PUSHER_APP_KEY' => env('PUSHER_APP_KEY'),
        'PUSHER_APP_SECRET' => env('PUSHER_APP_SECRET'),
        'PUSHER_APP_ID' => env('PUSHER_APP_ID'),
        'PUSHER_APP_CLUSTER' => env('PUSHER_APP_CLUSTER')
    ]);
    Event::dispatch(new MessageEvent(["username" => "Jardeson Erlan", "message" => "Funcionou de verdade oh"]));
    return "evento disparado";
});
