<?php

use App\Http\Controllers\V1\Accounts\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function(){
    dd('smile darling UwU');
});

Route::post('/signup',[AuthController::class,'signup']);
Route::post('/login', [AuthController::class,'login']);
Route::delete('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');