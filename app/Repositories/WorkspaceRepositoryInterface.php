<?php

namespace App\Repositories;

interface WorkspaceRepositoryInterface
{
    /**
     * ユーザーのワークスペースの情報を全て返す
     *
     * @param int $user_id
     * @return model Workspace
     */
    public function getWorkspaceInfos($user_id);

    /**
     * 特定のワークスペースの情報を返す
     *
     * @param int $workspace_id
     * @return model Workspace
     */
    public function getWorkspaceInfo($workspace_id);

    /**
     * ワークスペースを新規登録する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveWorkspaceInfo($post_data);
}