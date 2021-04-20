<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemoController;
use App\Models\Memo;

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
Route::prefix('workspace')->group(function () {
    Route::get('/register', [WorkspaceController::class, 'register'])->middleware(['auth'])->name('workspace.register');
    Route::post('/save', [WorkspaceController::class, 'save'])->middleware(['auth'])->name('workspace.save');
    Route::get('/detail/task/{workspace_id}', [WorkspaceController::class, 'taskDetail'])->middleware(['auth'])->name('workspace.task.detail');
    Route::get('/detail/memo/{workspace_id}', [WorkspaceController::class, 'memoDetail'])->middleware(['auth'])->name('workspace.memo.detail');
});

// タスク系
Route::prefix('task')->group(function () {
    Route::get('/register/{workspace_id}', [TaskController::class, 'register'])->middleware(['auth'])->name('task.register');
    Route::post('/save', [TaskController::class, 'save'])->middleware(['auth'])->name('task.save');
    Route::post('/status/change/complete', [TaskController::class, 'changeComplete'])->middleware(['auth'])->name('task.complete');
    Route::post('/status/change/incomplete', [TaskController::class, 'changeIncomplete'])->middleware(['auth'])->name('task.incomplete');
    Route::get('/detail/{workspace_id}/{task_id}', [TaskController::class, 'detail'])->middleware(['auth'])->name('task.detail');
    Route::get('/edit/{workspace_id}/{task_id}', [TaskController::class, 'edit'])->middleware(['auth'])->name('task.edit');
    Route::post('/update', [TaskController::class, 'update'])->middleware(['auth'])->name('task.update');
    Route::post('/delete', [TaskController::class, 'delete'])->middleware(['auth'])->name('task.delete');
    Route::post('/revive', [TaskController::class, 'revive'])->middleware(['auth'])->name('task.revive');
});

// メモ系
Route::prefix('memo')->group(function () {
    Route::get('/register/{workspace_id}', [MemoController::class, 'register'])->middleware(['auth'])->name('memo.register');
    Route::post('/save', [MemoController::class, 'save'])->middleware(['auth'])->name('memo.save');
    Route::get('/detail/{workspace_id}/{memo_id}', [MemoController::class, 'detail'])->middleware(['auth'])->name('memo.detail');
    Route::get('/edit/{workspace_id}/{memo_id}', [MemoController::class, 'edit'])->middleware(['auth'])->name('memo.edit');
    Route::post('/update', [MemoController::class, 'update'])->middleware(['auth'])->name('memo.update');
    Route::post('/delete', [MemoController::class, 'delete'])->middleware(['auth'])->name('memo.delete');
    Route::post('/revive', [MemoController::class, 'revive'])->middleware(['auth'])->name('memo.revive');
});
