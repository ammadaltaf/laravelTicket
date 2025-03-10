<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\UsersController;

Route::prefix('v1')->group(function(){
    Route::middleware('auth:sanctum')->apiResource('tickets',TicketController::class);
    Route::middleware('auth:sanctum')->apiResource('users',UsersController::class);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
