<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomAuth;
Route::get('',[AdminController::class,'Home']);
Route::get('LOGIN',[AdminController::class,'login']);
Route::get('registration',[AdminController::class,'registration']);
Route::post('store',[AdminController::class,'storeuser']);
Route::get('adminregistration',[AdminController::class,'adminregistration']);
Route::post('storeadmin',[AdminController::class,'storeadmin']);


Route::get('adminlogin',[AdminController::class,'adminlogin']);
Route::post('adminloginpass',[AdminController::class,'adminloginpass']);
Route::get('dashboard',[AdminController::class,'dashboard']);
Route::get('addscheme',[AdminController::class,'addscheme']);
Route::post('storescheme',[AdminController::class,'storescheme']);
Route::get('AdminScheme',[AdminController::class,'AdminScheme']);
Route::get('logout',[AdminController::class,'logout']);


Route::post('UserLogin',[CustomAuth::class,'UserLogin']);
Route::get('userdashboard',[CustomAuth::class,'userdashboard']);
Route::post('calculateInterest',[CustomAuth::class,'calculateInterest']);





