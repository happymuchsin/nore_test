<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListItemController;

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

Route::get('/', [LoginController::class, 'showLoginForm']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('user/json', [UserController::class, 'json']);
Route::get('user/{id}/edit', [UserController::class, 'edit']);
Route::post('user/crup', [UserController::class, 'crup']);
Route::get('user/delete/{id}', [UserController::class, 'destroy'])->middleware('admin');
Route::get('user/excel', [UserController::class, 'excel'])->middleware('admin');
Route::get('user/pdf', [UserController::class, 'pdf'])->middleware('admin');

Route::get('/list', [ListItemController::class, 'index'])->name('list');
Route::get('list/json', [ListItemController::class, 'json']);
Route::get('list/{id}/edit', [ListItemController::class, 'edit']);
Route::post('list/crup', [ListItemController::class, 'crup']);
Route::get('list/delete/{id}', [ListItemController::class, 'destroy']);
Route::get('list/excel', [ListItemController::class, 'excel']);
Route::get('list/pdf', [ListItemController::class, 'pdf']);
