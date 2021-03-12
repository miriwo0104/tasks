<?php

namespace App\Repositories;

interface WorkspaceRepositoryInterface
{
    /**
     * ユーザーのワークスペースの情報を返す
     *
     * @param int $userId
     * @return model Workspace
     */
    public function getWorkspaceInfo($userId);

    /**
     * ワークスペースを新規登録する
     *
     * @param array $postData
     * @return bool
     */
    public function saveWorkspaceInfo($postData);
}