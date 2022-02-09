<?php

use App\Http\Controllers\EssasebuzzController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    return view('index');
});
Route::post('response',[EssasebuzzController::class,'response2'])->name('response');
Route::post('start/', [EssasebuzzController::class,'store'])->name('start');