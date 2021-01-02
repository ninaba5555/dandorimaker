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

Route::post('task/up/{id}', [TaskController::class, 'up']);
Route::post('task/down/{id}', [TaskController::class, 'down']);

Route::get('plan', [PlanController::class, 'index']);
Route::get('plan/add', [PlanController::class, 'add']);
Route::post('plan/add', [PlanController::class, 'create']);
Route::get('plan/edit', [PlanController::class, 'edit']);
Route::post('plan/edit', [PlanController::class, 'update']);
Route::get('plan/del', [PlanController::class, 'delete']);
Route::post('plan/del', [PlanController::class, 'remove']);

Route::get('plan/do', [PlanController::class, 'do']);
Route::post('plan/do', [PlanController::class, 'doTask']);