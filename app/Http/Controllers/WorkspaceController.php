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

        $workspace_info = $this->workspaceService->getWorkspaceInfo($user_id);

        $post_data = [
            'page_name' => 'Workspace register',
            'workspace_info' => $workspace_info,
        ];

        return view('workspaces.register', ['post_data' => $post_data]);
    }

    /**
     * ワークスペースの新規登録
     *
     * @param WorkspaceRequest $postData
     * @return view
     */
    public function save(WorkspaceRequest $postData)
    {
        $postData['user_id'] = Auth::id();
        $this->workspaceService->saveWorkspaceInfo($postData);

        return redirect(route('top.index'));
    }
}
