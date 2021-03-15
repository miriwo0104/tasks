<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\WorkspaceService;

class TopController extends Controller
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

    public function index()
    {
        $user_id = Auth::id();
        $workspace_infos = $this->workspaceService->getWorkspaceInfos($user_id);

        $post_data = [
            'page_name' => 'Top',
            'workspace_infos' => $workspace_infos,
        ];

        return view('tops.index', ['post_data' => $post_data]);
    }
}
