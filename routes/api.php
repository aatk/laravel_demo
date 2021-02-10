<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers;
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


Route::get('/install', function (Request $request) {
    return "install";
});

Route::get('/get/{id}', function ($id, Request $request) {
    return $id;
});

Route::get('/list/{id}/{limit}', function ($id, $limit, Request $request) {
    return $id." - ".$limit;
});

Route::get('/search/{find}/{id}/{limit}', function ($find, $id, $limit, Request $request) {
    return $find." - ".$id." - ".$limit;
});

Route::post('/post', function (Request $request) {
    return "post";
});

Route::put('/put', function (Request $request) {
    return "put";
});

Route::delete('/delete', function (Request $request) {
    return "delete";
});
