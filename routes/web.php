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

Route::get('user/create', [\App\Http\Controllers\UserController::class, 'create'])
    ->name('user.create');

Route::post('user/store', [\App\Http\Controllers\UserController::class, 'store'])
    ->name('user.store');

Route::post('login', [\App\Http\Controllers\UserController::class, 'login'])
    ->name('login');

Route::get('login', function () {
    return view('components.login')
        ->with('title', 'login')
        ->with('message', session('message'));
})->name('login.page');

Route::middleware(['auth'])->group(function () {
    Route::get('users/{offset?}', [\App\Http\Controllers\UserController::class, 'index'])
        ->name('user.index');

    Route::get('tasks/{user?}', [\App\Http\Controllers\TaskController::class, 'index'])
        ->name('task.index');

    Route::get('task/create', [\App\Http\Controllers\TaskController::class, 'create'])
        ->name('task.create');

    Route::post('task/store', [\App\Http\Controllers\TaskController::class, 'store'])
        ->name('task.store');

    Route::get('task/{task}', [\App\Http\Controllers\TaskController::class, 'show'])
        ->name('task.show');

    Route::post('logout', [\App\Http\Controllers\UserController::class, 'logout'])
        ->name('logout');

    Route::delete('delete/{id}', [\App\Http\Controllers\TaskController::class, 'delete'])
        ->name('task.delete');

    Route::put('update/{id}', [\App\Http\Controllers\TaskController::class, 'toggleToDo'])
        ->name('task.update');

    Route::patch('update/{id}', [\App\Http\Controllers\TaskController::class, 'restore'])
        ->name('task.restore');

    Route::delete('force/{id}', [\App\Http\Controllers\TaskController::class, 'force'])
        ->name('task.force');

    Route::get('trash/{user}', [\App\Http\Controllers\TaskController::class, 'trash'])
        ->name('task.trash');
});
