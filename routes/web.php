<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

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

Route::get('task', [Taskcontroller::class, 'index']);
Route::get('task/add', [Taskcontroller::class, 'add']);
Route::post('task/add', [Taskcontroller::class, 'create']);
Route::get('task/edit', [Taskcontroller::class, 'edit']);
Route::post('task/edit', [Taskcontroller::class, 'update']);
Route::get('task/del', [Taskcontroller::class, 'delete']);
Route::post('task/del', [Taskcontroller::class, 'remove']);
