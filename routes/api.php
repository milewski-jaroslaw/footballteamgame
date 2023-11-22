<?php

use App\Http\Controllers\Api\Authorization\LoginController;
use App\Http\Controllers\Api\Cards\CreateAction;
use App\Http\Controllers\Api\Duels\GetActiveAction;
use App\Http\Controllers\Api\Duels\GetHistoryAction;
use App\Http\Controllers\Api\Duels\PerformAction;
use App\Http\Controllers\Api\Duels\StartAction;
use App\Http\Controllers\Api\Users\GetDataAction;
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

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

//USER DATA
Route::get('user-data', GetDataAction::class);

Route::group(['middleware' => ['auth:sanctum']], static function () {

    //START THE DUEL
    Route::post('duels', StartAction::class);

    //CURRENT GAME DATA
    Route::get('duels/active', GetActiveAction::class);

    //User has just selected a card
    Route::post('duels/action', PerformAction::class);

    //DUELS HISTORY
    Route::get('duels', GetHistoryAction::class);

    //CARDS
    Route::post('cards', CreateAction::class);
});
