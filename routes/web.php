<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\PlanController;

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
});

Route::get('task', [TaskController::class, 'index']);
Route::get('task/add', [TaskController::class, 'add']);
Route::post('task/add', [TaskController::class, 'create']);
Route::get('task/edit', [TaskController::class, 'edit']);
Route::post('task/edit', [TaskController::class, 'update']);
Route::get('task/del', [TaskController::class, 'delete']);
Route::post('task/del', [TaskController::class, 'remove']);

Route::get('plan', [PlanController::class, 'index']);
Route::get('plan/add', [PlanController::class, 'add']);
Route::post('plan/add', [PlanController::class, 'create']);
