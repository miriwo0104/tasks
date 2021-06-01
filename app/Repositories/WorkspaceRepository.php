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
     * ユーザーのワークスペースの情報を全て返す
     *
     * @param int $user_id
     * @return model Workspace
     */
    public function getWorkspaceInfos($user_id)
    {
        return $this->workspace->where('user_id', $user_id)->get();
    }

    /**
     * 特定のワークスペースの情報を返す
     *
     * @param int $workspace_id
     * @return model Workspace
     */
    public function getWorkspaceInfo($workspace_id)
    {
        return $this->workspace->find($workspace_id);
    }

    /**
     * ワークスペースを新規登録する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveWorkspaceInfo($post_data)
    {
        $workspace = $this->workspace;
        $workspace->user_id = $post_data['user_id'];
        $workspace->name = $post_data['workspace_name'];

        return $workspace->save();
    }
}