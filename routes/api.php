<?php

use App\Http\Controllers\IndexController;
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


Route::get('/install', [ IndexController::class, 'install' ]);

Route::get('/get/{id}', [ IndexController::class, 'getid' ]);

Route::get('/list/{id}/{limit}', [ IndexController::class, 'list' ]);

Route::get('/search/{find}/{id}/{limit}', [ IndexController::class, 'search' ]);

Route::post('/post', [ IndexController::class, 'post' ]);

Route::put('/put', [ IndexController::class, 'put' ]);

Route::delete('/delete', [ IndexController::class, 'delete' ]);
