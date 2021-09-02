<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])
    ->name('user.index');

Route::get('user/create', [\App\Http\Controllers\UserController::class, 'create'])
    ->name('user.create');

Route::post('user/store', [\App\Http\Controllers\UserController::class, 'store'])
    ->name('user.store');

Route::get('tasks', [\App\Http\Controllers\TaskController::class, 'index'])
    ->name('task.index');

Route::get('task/create', [\App\Http\Controllers\TaskController::class, 'create'])
    ->name('task.create');

Route::post('task/store', [\App\Http\Controllers\TaskController::class, 'store'])
    ->name('task.store');

Route::get('task/{task}', [\App\Http\Controllers\TaskController::class, 'show'])
    ->name('task.show');

Route::post('login', [\App\Http\Controllers\UserController::class, 'login'])
    ->name('login');

Route::post('logout', [\App\Http\Controllers\UserController::class, 'logout'])
    ->name('logout');

Route::get('login', function () {
    return view('components.login');
})->name('login.page');

