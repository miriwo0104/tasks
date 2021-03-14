<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    /**
     * Tasksの全ての内容を返す
     *
     * @param int $workspace_id
     * @param int $limit_id
     * @return model Task
     */
    public function getTaskInfos($workspace_id, $limit_id);

    /**
     * Taskを保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveTaskInfo($post_data);
}