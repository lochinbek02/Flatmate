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
//Flatmate platformasi uchun tizimga kirish Api
Route::post('/login',[MainApiController::class,'login']);
//Flatmate platformasi uchun tizimdan ro'yxatdan o'tish Api
Route::post('/register',[MainApiController::class,'register']);
//Flatmate platformasi foydalanuvchilar ro'yxatini ko'rish
Route::middleware('auth:sanctum')->get('/home',[MainApiController::class,'home']);
// Flatmate platformasi uchun foydalanuvchilar bir biriga do'stlik so'rovini jo'natish 
Route::middleware('auth:sanctum')->post('/like',[MainApiController::class,'like']);
// Flatmate platformasi uchun foydalanuvchilar bir biriga xabar yubora olishlari uchun APi
Route::middleware('auth:sanctum')->post('/message',[MainApiController::class,'message']);
// Flatmate platformasi uchun foydalanuvchilar bir biriga xabar yuboragan xabarlarni ko'ra olishlari uchun APi
Route::middleware('auth:sanctum')->post('/message-show',[MainApiController::class,'messageshow']);
// Foydalanuvchilarni topish uchun qidiruv API
Route::middleware('auth:sanctum')->post('/search',[MainApiController::class,'search']);
// Foydalanuvchilar malumotlarni yangilay olishlari uchun APi
Route::middleware('auth:sanctum')->post('/update',[MainApiController::class,'update']);
