<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LimitService;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     *
     * @var LimitService
     */
    public $limitService;

    /**
     *
     * @var TaskService
     */
    public $taskService;

    /**
     *
     * @param LimitService $limitService
     */
    public function __construct(
        LimitService $limitService,
        TaskService $taskService
    )
    {
        $this->limitService = $limitService;
        $this->taskService = $taskService;
    }

    /**
     * タスクの登録画面
     *
     * @param int $workspace_id
     * @return view
     */
    public function register($workspace_id)
    {
        $limits = $this->limitService->getLimitInfos();

        $post_data = [
            'page_name' => 'TODO register',
            'workspace_id' => $workspace_id,
            'limits' => $limits,
        ];

        return view('tasks.register', ['post_data' => $post_data]);
    }

    /**
     * タスクの登録
     *
     * @param TodoRequest $post_data
     * @return redirect
     */
    public function save(TaskRequest $post_data)
    {
        $post_data['user_id'] = Auth::id();
        $this->taskService->saveTaskInfo($post_data);

        return redirect(route('workspace.detail', ['workspace_id' => $post_data['workspace_id']]));
    }

    /**
     * タスクのステータスを完了に変更する
     *
     * @param Request $post_data
     * @return bool
     */
    public function changeComplete(Request $post_data)
    {
        $this->taskService->changeComplete($post_data['task_id']);
        return redirect(route('workspace.detail', ['workspace_id' => $post_data['workspace_id']]));
    }

    /**
     * タスクのステータスを未完了に変更する
     *
     * @param Request $post_data
     * @return bool
     */
    public function changeIncomplete(Request $post_data)
    {
        $this->taskService->changeIncomplete($post_data['task_id']);
        return redirect(route('workspace.detail', ['workspace_id' => $post_data['workspace_id']]));
    }

    /**
     * タスクの詳細
     *
     * @param int $task_id
     * @return view
     */
    public function detail($workspace_id, $task_id)
    {
        $task_info = $this->taskService->getTaskInfoByTaskId($task_id);
        $post_data = [
            'page_name' => 'Task詳細',
            'task_info' => $task_info,
            'workspace_id' => $workspace_id,
        ];

        return view('tasks.detail', ['post_data' => $post_data]);
    }

    /**
     * タスク情報編集
     *
     * @param int $task_id
     * @return view
     */
    public function edit($workspace_id, $task_id)
    {
        $task_info = $this->taskService->getTaskInfoByTaskId($task_id);
        $limits = $this->limitService->getLimitInfos();

        $post_data = [
            'page_name' => 'Task編集',
            'task_info' => $task_info,
            'limits' => $limits,
            'workspace_id' => $workspace_id,
        ];

        return view('tasks.edit', ['post_data' => $post_data]);
    }

    /**
     * 編集したタスク情報を登録
     *
     * @param TaskRequest $post_data
     * @return redirect
     */
    public function update(TaskRequest $post_data)
    {
        $post_data['user_id'] = Auth::id();
        $this->taskService->updateTaskInfo($post_data);

        return redirect(route('workspace.detail', ['workspace_id' => $post_data['workspace_id']]));
    }

    /**
     * タスクの削除
     *
     * @param int $task_id
     * @return redirect
     */
    public function delete(Request $post_data)
    {
        $this->taskService->deleteTaskByTaskId($post_data['task_id']);

        return redirect(route('workspace.detail', ['workspace_id' => $post_data['workspace_id']]));
    }

    /**
     * 削除状態タスクの復帰
     *
     * @param int $task_id
     * @return redirect
     */
    public function revive(Request $post_data)
    {
        $this->taskService->reviveDeletedTaskByTaskId($post_data['task_id']);

        return redirect(route('workspace.detail', ['workspace_id' => $post_data['workspace_id']]));
    }
}
