<?php

use App\Http\Controllers\TestapiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('stu', [TestapiController::class,'index']);
Route::get('stu/{id}', [TestapiController::class,'show']);
Route::get('s/{city}', [TestapiController::class,'search']);
Route::post('stu1/{id}',[TestapiController::class,'edit']);
Route::post('stu2/{id}',[TestapiController::class],'update');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
