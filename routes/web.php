<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\WorkspaceController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/top', [TopController::class, 'index'])->name('top.index');

Route::get('/workspace/register', [WorkspaceController::class, 'register'])->name('workspace.register');
Route::post('/workspace/save', [WorkspaceController::class, 'save'])->name('workspace.save');
Route::get('/workspace/detail/{workspace_id}', [WorkspaceController::class, 'detail'])->name('workspace.detail');

Route::get('/task/register/{workspace_id}', [TaskController::class, 'register'])->name('task.register');
Route::post('/task/save', [TaskController::class, 'save'])->name('task.save');
Route::post('/task/status/change/complete', [TaskController::class, 'changeComplete'])->name('task.complete');
Route::post('/task/status/change/incomplete', [TaskController::class, 'changeIncomplete'])->name('task.incomplete');
