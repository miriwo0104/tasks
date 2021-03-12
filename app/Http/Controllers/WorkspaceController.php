<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkspaceRequest;
use App\Services\WorkspaceService;
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
     * @param WorkspaceService $workspaceService
     */
    public function __construct(WorkspaceService $workspaceService)
    {
        $this->workspaceService = $workspaceService;
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

    public function detail($workspace_id)
    {
        $user_id = Auth::id();
        $workspace_info = $this->workspaceService->getWorkspaceInfo($workspace_id);

        $post_data = [
            'page_name' => $workspace_info->name,
            'workspace_info' => $workspace_info,
        ];

        return view('workspaces.detail', ['post_data' => $post_data]);
    }
}
