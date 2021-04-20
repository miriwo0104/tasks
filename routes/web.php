<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemoController;

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

// ワークスペース系
Route::prefix('workspace')->name('workspace.')->group(function () {
    Route::get('/register', [WorkspaceController::class, 'register'])->middleware(['auth'])->name('register');
    Route::post('/save', [WorkspaceController::class, 'save'])->middleware(['auth'])->name('save');
    Route::get('/detail/task/{workspace_id}', [WorkspaceController::class, 'taskDetail'])->middleware(['auth'])->name('task.detail');
    Route::get('/detail/memo/{workspace_id}', [WorkspaceController::class, 'memoDetail'])->middleware(['auth'])->name('memo.detail');
});

// タスク系
Route::prefix('task')->name('task.')->group(function () {
    Route::get('/register/{workspace_id}', [TaskController::class, 'register'])->middleware(['auth'])->name('register');
    Route::post('/save', [TaskController::class, 'save'])->middleware(['auth'])->name('save');
    Route::post('/status/change/complete', [TaskController::class, 'changeComplete'])->middleware(['auth'])->name('complete');
    Route::post('/status/change/incomplete', [TaskController::class, 'changeIncomplete'])->middleware(['auth'])->name('incomplete');
    Route::get('/detail/{workspace_id}/{task_id}', [TaskController::class, 'detail'])->middleware(['auth'])->name('detail');
    Route::get('/edit/{workspace_id}/{task_id}', [TaskController::class, 'edit'])->middleware(['auth'])->name('edit');
    Route::post('/update', [TaskController::class, 'update'])->middleware(['auth'])->name('update');
    Route::post('/delete', [TaskController::class, 'delete'])->middleware(['auth'])->name('delete');
    Route::post('/revive', [TaskController::class, 'revive'])->middleware(['auth'])->name('revive');
});

// メモ系
Route::prefix('memo')->name('memo.')->group(function () {
    Route::get('/register/{workspace_id}', [MemoController::class, 'register'])->middleware(['auth'])->name('register');
    Route::post('/save', [MemoController::class, 'save'])->middleware(['auth'])->name('save');
    Route::get('/detail/{workspace_id}/{memo_id}', [MemoController::class, 'detail'])->middleware(['auth'])->name('detail');
    Route::get('/edit/{workspace_id}/{memo_id}', [MemoController::class, 'edit'])->middleware(['auth'])->name('edit');
    Route::post('/update', [MemoController::class, 'update'])->middleware(['auth'])->name('update');
    Route::post('/delete', [MemoController::class, 'delete'])->middleware(['auth'])->name('delete');
    Route::post('/revive', [MemoController::class, 'revive'])->middleware(['auth'])->name('revive');
});
