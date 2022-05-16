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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/user', function (Request $request) {
//     return response()->json($request->user());
// });

Route::get('/dashboard','App\Http\Controllers\Main@dashboard');

Route::post('/user-registration','App\Http\Controllers\Authentication@registration');
Route::post('/user-login','App\Http\Controllers\Authentication@login');
Route::get('/user-info/{id}','App\Http\Controllers\Authentication@userInfo');

Route::get('/hospital-list','App\Http\Controllers\HospitalController@hospitalList');
Route::get('/search-hospital','App\Http\Controllers\HospitalController@searchHospital');
Route::get('/get-district','App\Http\Controllers\HospitalController@getDistrict');
Route::get('/get-thana/{district_id}','App\Http\Controllers\HospitalController@getThana');

Route::post('/add-hospital','App\Http\Controllers\HospitalController@addHospital');
Route::get('/single-hospital/{id}','App\Http\Controllers\HospitalController@singleHospital');
Route::post('/update-hospital/{id}','App\Http\Controllers\HospitalController@updateHospital');
Route::post('/delete-hospital/{id}','App\Http\Controllers\HospitalController@deleteHospital');

Route::post('/logout','App\Http\Controllers\Authentication@logout')->middleware('auth:sanctum');

