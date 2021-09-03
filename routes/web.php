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
    ->name('user.index')->middleware(\App\Http\Middleware\Authenticate::class);

Route::get('user/create', [\App\Http\Controllers\UserController::class, 'create'])
    ->name('user.create');

Route::post('user/store', [\App\Http\Controllers\UserController::class, 'store'])
    ->name('user.store');

Route::get('tasks/{user}', [\App\Http\Controllers\TaskController::class, 'index'])
    ->name('task.index')->middleware(\App\Http\Middleware\Authenticate::class);

Route::get('task/create', [\App\Http\Controllers\TaskController::class, 'create'])
    ->name('task.create')->middleware(\App\Http\Middleware\Authenticate::class);

Route::post('task/store', [\App\Http\Controllers\TaskController::class, 'store'])
    ->name('task.store')->middleware(\App\Http\Middleware\Authenticate::class);

Route::get('task/{task}', [\App\Http\Controllers\TaskController::class, 'show'])
    ->name('task.show')->middleware(\App\Http\Middleware\Authenticate::class);

Route::post('login', [\App\Http\Controllers\UserController::class, 'login'])
    ->name('login');

Route::post('logout', [\App\Http\Controllers\UserController::class, 'logout'])
    ->name('logout')->middleware(\App\Http\Middleware\Authenticate::class);

Route::get('login', function () {
    return view('components.login')->with('title', 'login')->with('message', session('message'));
})->name('login.page');

