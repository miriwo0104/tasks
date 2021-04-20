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

// ログイン必須ページ
Route::middleware('auth')->group(function() {
    // ワークスペース系
    Route::prefix('workspace')->name('workspace.')->group(function () {
        Route::get('/register', [WorkspaceController::class, 'register'])->name('register');
        Route::post('/save', [WorkspaceController::class, 'save'])->name('save');
        Route::get('/detail/task/{workspace_id}', [WorkspaceController::class, 'taskDetail'])->name('task.detail');
        Route::get('/detail/memo/{workspace_id}', [WorkspaceController::class, 'memoDetail'])->name('memo.detail');
    });

    // タスク系
    Route::prefix('task')->name('task.')->group(function () {
        Route::get('/register/{workspace_id}', [TaskController::class, 'register'])->name('register');
        Route::post('/save', [TaskController::class, 'save'])->name('save');
        Route::post('/status/change/complete', [TaskController::class, 'changeComplete'])->name('complete');
        Route::post('/status/change/incomplete', [TaskController::class, 'changeIncomplete'])->name('incomplete');
        Route::get('/detail/{workspace_id}/{task_id}', [TaskController::class, 'detail'])->name('detail');
        Route::get('/edit/{workspace_id}/{task_id}', [TaskController::class, 'edit'])->name('edit');
        Route::post('/update', [TaskController::class, 'update'])->name('update');
        Route::post('/delete', [TaskController::class, 'delete'])->name('delete');
        Route::post('/revive', [TaskController::class, 'revive'])->name('revive');
    });

    // メモ系
    Route::prefix('memo')->name('memo.')->group(function () {
        Route::get('/register/{workspace_id}', [MemoController::class, 'register'])->name('register');
        Route::post('/save', [MemoController::class, 'save'])->name('save');
        Route::get('/detail/{workspace_id}/{memo_id}', [MemoController::class, 'detail'])->name('detail');
        Route::get('/edit/{workspace_id}/{memo_id}', [MemoController::class, 'edit'])->name('edit');
        Route::post('/update', [MemoController::class, 'update'])->name('update');
        Route::post('/delete', [MemoController::class, 'delete'])->name('delete');
        Route::post('/revive', [MemoController::class, 'revive'])->name('revive');
    });
});
