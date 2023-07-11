<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StateController;



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
Route::post("loginindex",[UserController::class,'loginindex']);


Route::get("userdata/{id?}",[UserController::class,'getUserData']);
Route::post("addUserData",[UserController::class,'addUserData']);
Route::delete("deleteUserData/{id?}",[UserController::class,'deleteUserData']);

Route::get("companydata/{id?}",[CompanyController::class,'getCompanyData']);
Route::delete("deleteCompanyData/{id?}",[CompanyController::class,'deleteCompanyData']);
Route::post("addCompanyData",[CompanyController::class,'addCompanyData']);

Route::get("locationdata/{id?}",[LocationController::class,'getLocationData']);
Route::post("addLocationData",[LocationController::class,'addLocationData']);
Route::delete("deleteLocationData/{id?}",[LocationController::class,'deleteLocationData']);


Route::get("stateData/{id?}",[StateController::class,'getStateData']);
Route::post("addStateData",[StateController::class,'addStateData']);
Route::delete("deleteStateData/{id?}",[StateController::class,'deleteStateData']);


Route::resource('users',App\Http\Controllers\UserController::class)->only(['index']);

Route::post('/roleconnect/update', 'UserroleController@updateRoleConnect')->name('roleconnect.update');

Route::post('/store-role-connect', 'RoleConnectController@store')->name('storeRoleConnect');
