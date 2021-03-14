<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkspaceRequest;
use App\Services\WorkspaceService;
use App\Services\TaskService;
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
     * @param WorkspaceService $workspaceService
     */
    public function __construct(
        WorkspaceService $workspaceService,
        TaskService $taskService
        )
    {
        $this->workspaceService = $workspaceService;
        $this->taskService = $taskService;
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
    public function detail($workspace_id)
    {
        $user_id = Auth::id();

        $today_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.today'));
        $tomorrow_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.tomorrow'));
        $week_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.week'));
        $month_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.month'));
        $undecided_task_infos = $this->taskService->getTaskInfos($workspace_id, config('const.limit.undecided'));

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
            ],
        ];

        return view('workspaces.detail', ['post_data' => $post_data]);
    }
}
