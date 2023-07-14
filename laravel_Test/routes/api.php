<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('v1/licence', 'custamer\custemer@licenceAdd');
Route::post('v1/getlicenceall','custamer\custemer@getlicenceall');
Route::post('v1/licencegetID','custamer\custemer@licencegetID');
Route::post('v1/deleteLicence','custamer\custemer@deleteLicence');









