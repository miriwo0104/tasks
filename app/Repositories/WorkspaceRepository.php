<?php

namespace App\Repositories;

use App\Models\Workspace;

class WorkspaceRepository implements WorkspaceRepositoryInterface
{
    /**
     *
     * @var Workspace
     */
    private $workspace;

    /**
     *
     * @param Workspace $workspace
     */
    public function __construct(Workspace $workspace)
    {
        $this->workspace = $workspace;
    }

    /**
     * ユーザーのワークスペースの情報を返す
     *
     * @param int $userId
     * @return model Workspace
     */
    public function getWorkspaceInfo($userId)
    {
        return $this->workspace->where('user_id', $userId)->get();
    }

    /**
     * ワークスペースを新規登録する
     *
     * @param array $postData
     * @return bool
     */
    public function saveWorkspaceInfo($postData)
    {
        $workspace = $this->workspace;
        $workspace->user_id = $postData['user_id'];
        $workspace->name = $postData['workspace_name'];
        
        return $workspace->save();
    }
}