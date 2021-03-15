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

        return view('todos.register', ['post_data' => $post_data]);
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
    public function changeUncomplete(Request $post_data)
    {
        $this->taskService->changeUncomplete($post_data['task_id']);
        return redirect(route('workspace.detail', ['workspace_id' => $post_data['workspace_id']]));
    }
}
