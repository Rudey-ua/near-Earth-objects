<?php

use App\Http\Controllers\Api\DefaultController;
use Illuminate\Http\Request;
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

Route::get('/',[DefaultController::class, 'index'])->name('api.index.page');
Route::get('/neo/hazardous',[DefaultController::class, 'getDangerAsteroids'])->name('api.danger.page');
Route::get('/neo/fastest',[DefaultController::class, 'getFastestAsteroids'])->name('api.fastest.page');

Route::get('/nasa',[DefaultController::class, 'store']);
