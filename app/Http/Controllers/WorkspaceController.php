<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkspaceRequest;
use App\Services\WorkspaceService;
use App\Services\TaskService;
use App\Services\MemoService;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{

    /**
     *
     * @var Workspace
     */
    private $workspaceService;

    /**
     *
     * @var Task
     */
    private $taskService;

    /**
     *
     * @var Memo
     */
    private $memoService;

    /**
     *
     * @param WorkspaceService $workspaceService
     */
    public function __construct(
        WorkspaceService $workspaceService,
        TaskService $taskService,
        MemoService $memoService
        )
    {
        $this->workspaceService = $workspaceService;
        $this->taskService = $taskService;
        $this->memoService = $memoService;
    }

    /**
     * ワークスペース登録ページ表示
     *
     * @return view
     */
    public function register()
    {
        $user_id = Auth::id();

        $workspace_infos = $this->workspaceService->getWorkspaceInfos($user_id);

        $post_data = [
            'page_name' => 'Workspace register',
            'workspace_infos' => $workspace_infos,
        ];

        return view('workspaces.register', ['post_data' => $post_data]);
    }

    /**
     * ワークスペースの新規登録
     *
     * @param WorkspaceRequest $post_data
     * @return view
     */
    public function save(WorkspaceRequest $post_data)
    {
        $post_data['user_id'] = Auth::id();
        $this->workspaceService->saveWorkspaceInfo($post_data);

        return redirect(route('top.index'));
    }

    /**
     * ワークスペースの詳細ページ表示
     *
     * @param [type] $workspace_id
     * @return void
     */
    public function taskDetail($workspace_id)
    {
        $today_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.today'));
        $tomorrow_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.tomorrow'));
        $week_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.week'));
        $month_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.month'));
        $undecided_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.undecided'));
        $complete_task_infos = $this->taskService->getCompleteTaskInfos($workspace_id);
        $delete_task_infos = $this->taskService->getReviveDeletedTaskByTaskId($workspace_id);

        $workspace_info = $this->workspaceService->getWorkspaceInfo($workspace_id);

        $post_data = [
            'page_name' => $workspace_info->name,
            'workspace_info' => $workspace_info,
            'task_infos' => [
                'today_task_infos' => $today_task_infos,
                'tomorrow_task_infos' => $tomorrow_task_infos,
                'week_task_infos' => $week_task_infos,
                'month_task_infos' => $month_task_infos,
                'undecided_task_infos' => $undecided_task_infos,
                'complete_task_infos' => $complete_task_infos,
                'delete_task_infos' => $delete_task_infos,
            ],
        ];

        return view('workspaces.tasks.detail', ['post_data' => $post_data]);
    }

    /**
     * メモの一覧を表示
     *
     * @param int $workspace_id
     * @return view
     */
    public function memoDetail($workspace_id)
    {
        $memo_infos = $this->memoService->getMemoInfos($workspace_id);
        $delete_memo_infos = $this->memoService->getReviveDeletedMemoByMemoId($workspace_id);

        $workspace_info = $this->workspaceService->getWorkspaceInfo($workspace_id);

        $post_data = [
            'page_name' => $workspace_info->name,
            'workspace_info' => $workspace_info,
            'memo_infos' => [
                'memo_infos' => $memo_infos,
                'delete_memo_infos' => $delete_memo_infos,
            ],
        ];
        return view('workspaces.memos.detail', ['post_data' => $post_data]);
    }
}
