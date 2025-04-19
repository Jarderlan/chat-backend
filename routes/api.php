<?php

use App\Events\MessageEvent;
use App\Http\Controllers\{AuthController, ChatController, UserController};
use Illuminate\Support\Facades\{Route, Event};

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
});

Route::resource('user', UserController::class); //Middleware sendo aplicado no proprio controler para remover o store
Route::group(['middleware' => 'auth:sanctum'], function () {
    //Rotas autenticadas
    Route::get('/chat/all', [ChatController::class, 'getLastPublicMessages']);
    Route::post('/chat/all', [ChatController::class, 'publicChat']);
});

Route::get('teste', function () {
    Event::dispatch(new MessageEvent(["user" => ["id" => 0, "name" => "Jardeson Erlan"], "message" => "Funcionou de verdade oh"]));
    return "evento disparado";
});
