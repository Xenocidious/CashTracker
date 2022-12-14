<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ExpenseController;

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

Route::get('register', [UserController::class, 'registerPage'])->name('register')->middleware('guest');
Route::post('register', [UserController::class, 'store'])->middleware('guest');
Route::get('login', [UserController::class, 'loginPage'])->middleware('guest');
Route::post('login', [UserController::class, 'login'])->middleware('guest');
Route::post('logout', [UserController::class, 'logout']);

Route::get('home', [GroupController::class, 'home'])->middleware('auth');

Route::get('group/{id}', [GroupController::class, 'group'])->middleware('auth');
Route::post('group/create', [GroupController::class, 'create'])->middleware('auth');
Route::post('group/join', [GroupController::class, 'join'])->middleware('auth');

Route::get('group/{id}/generateInvite', [GroupController::class, 'generateInvite'])->middleware('auth');

Route::post('expense/create/{group_id}', [ExpenseController::class, 'create'])->middleware('auth');
Route::get('expense/edit/{ids}', [ExpenseController::class, 'edit'])->middleware('auth');
Route::post('expense/update/{id}', [ExpenseController::class, 'update'])->middleware('auth');
Route::get('expense/delete/{id}', [ExpenseController::class, 'delete'])->middleware('auth');