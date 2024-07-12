<?php

use App\Http\Controllers\WebController;
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

Auth::routes();

Route::middleware('auth:sanctum')->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth:sanctum')->get('/about_user/{id}',[WebController::class,'about_user'])->name('about_user');
Route::middleware('auth:sanctum')->post('/like',[WebController::class,'like'])->name('like');
// Flatmate platformasi uchun foydalanuvchilar bir biriga xabar yubora olishlari uchun APi
Route::middleware('auth:sanctum')->post('/message',[WebController::class,'message'])->name('message');
// Flatmate platformasi uchun foydalanuvchilar bir biriga xabar yuboragan xabarlarni ko'ra olishlari uchun APi
Route::middleware('auth:sanctum')->post('/message-show',[WebController::class,'messageshow'])->name('messageshow');
// Foydalanuvchilarni topish uchun qidiruv API
Route::middleware('auth:sanctum')->post('/search',[WebController::class,'search'])->name('search');
// Foydalanuvchilar malumotlarni yangilay olishlari uchun APi
Route::middleware('auth:sanctum')->post('/update',[WebController::class,'update'])->name('update');
Route::middleware('auth:sanctum')->get('/notifications',[WebController::class,'notifications'])->name('notifications');