<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;

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

Route::get('/', [UserController::class, 'registerPage'])->middleware('guest');

Route::get('register', [UserController::class, 'registerPage'])->middleware('guest');
Route::post('register', [UserController::class, 'store'])->middleware('guest');
Route::get('login', [UserController::class, 'loginPage']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

Route::get('home', [GroupController::class, 'home'])->middleware('auth');

Route::post('group/create', [GroupController::class, 'create'])->middleware('auth');
Route::post('group/join', [GroupController::class, 'join'])->middleware('auth');
