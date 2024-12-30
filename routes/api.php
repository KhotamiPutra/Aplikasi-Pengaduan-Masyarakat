<?php

use App\Http\Controllers\MobileAPIController;
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

Route::get('/masyarakat', [MobileAPIController::class, 'index'])->name('index');
Route::post('/register', [MobileAPIController::class, 'register'])->name('register');
Route::post('/check-username', [MobileAPIController::class, 'chekusername'])->name('chekusername');
Route::post('/login',[MobileAPIController::class, 'login'])->name('login');
