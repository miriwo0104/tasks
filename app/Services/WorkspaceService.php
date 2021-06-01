<?php

namespace App\Services;

use App\Repositories\WorkspaceRepositoryInterface as WorkspaceRepository;

class WorkspaceService
{
    /**
     *
     * @var Workspace
     */
    private $workspaceRepository;

    /**
     *
     * @param WorkspaceRepository $workspaceRepository
     */
    public function __construct(WorkspaceRepository $workspaceRepository)
    {
        $this->workspaceRepository = $workspaceRepository;
    }

    /**
     * ユーザーのワークスペースの情報を全て返す
     *
     * @param int $user_id
     * @return model Workspace
     */
    public function getWorkspaceInfos($user_id)
    {
        return $this->workspaceRepository->getWorkspaceInfos($user_id);
    }

    /**
     * 特定のワークスペースの情報を返す
     *
     * @param int $workspace_id
     * @return model Workspace
     */
    public function getWorkspaceInfo($workspace_id)
    {
        return $this->workspaceRepository->getWorkspaceInfo($workspace_id);
    }

    /**
     * ワークスペースを新規登録する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveWorkspaceInfo($post_data)
    {
        return $this->workspaceRepository->saveWorkspaceInfo($post_data);
    }
}
