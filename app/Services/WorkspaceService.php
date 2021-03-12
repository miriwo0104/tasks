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
     * ユーザーのワークスペースの情報を返す
     *
     * @param int $userId
     * @return model Workspace
     */
    public function getWorkspaceInfo($userId)
    {
        return $this->workspaceRepository->getWorkspaceInfo($userId);
    }

    /**
     * ワークスペースを新規登録する
     *
     * @param array $postData
     * @return bool
     */
    public function saveWorkspaceInfo($postData)
    {
        return $this->workspaceRepository->saveWorkspaceInfo($postData);
    }
}
