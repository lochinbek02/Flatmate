<?php

use App\Http\Controllers\MainApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login',[MainApiController::class,'login']);
Route::post('/register',[MainApiController::class,'register']);
Route::middleware('auth:sanctum')->get('/home',[MainApiController::class,'home']);
// Route::middleware('auth:sanctum')->get('/home',[MainApiController::class,'home']);