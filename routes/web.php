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

Route::get('/top', [TopController::class, 'index'])->middleware(['auth'])->name('top.index');

Route::get('/workspace/register', [WorkspaceController::class, 'register'])->middleware(['auth'])->name('workspace.register');
Route::post('/workspace/save', [WorkspaceController::class, 'save'])->middleware(['auth'])->name('workspace.save');
Route::get('/workspace/detail/{workspace_id}', [WorkspaceController::class, 'detail'])->middleware(['auth'])->name('workspace.detail');

Route::get('/task/register/{workspace_id}', [TaskController::class, 'register'])->middleware(['auth'])->name('task.register');
Route::post('/task/save', [TaskController::class, 'save'])->middleware(['auth'])->name('task.save');
Route::post('/task/status/change/complete', [TaskController::class, 'changeComplete'])->middleware(['auth'])->name('task.complete');
Route::post('/task/status/change/incomplete', [TaskController::class, 'changeIncomplete'])->middleware(['auth'])->name('task.incomplete');
Route::get('/task/detail/{workspace_id}/{task_id}', [TaskController::class, 'detail'])->middleware(['auth'])->name('task.detail');
Route::get('/task/edit/{workspace_id}/{task_id}', [TaskController::class, 'edit'])->middleware(['auth'])->name('task.edit');
Route::post('/task/update', [TaskController::class, 'update'])->middleware(['auth'])->name('task.update');
Route::post('/task/delete', [TaskController::class, 'delete'])->middleware(['auth'])->name('task.delete');