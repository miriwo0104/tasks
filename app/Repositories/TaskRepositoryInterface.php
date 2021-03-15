<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    /**
     * ワークスペースIDに紐付いた未完了タスクを返す
     *
     * @param int $workspace_id
     * @param int $limit_id
     * @return model Task
     */
    public function getTaskInfos($workspace_id, $limit_id);

    /**
     * ワークスペースIDに紐付いた完了タスクを返す
     *
     * @param int $workspace_id
     * @param int $limit_id
     * @return model Task
     */
    public function getCompleteTaskInfos($workspace_id);

    /**
     * タスクを保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveTaskInfo($post_data);

    /**
     * タスクのステータスを完了に変更する
     *
     * @param int $task_id
     * @return bool
     */
    public function changeComplete($task_id);

    /**
     * タスクのステータスを未完了に変更する
     *
     * @param int $task_id
     * @return bool
     */
    public function changeIncomplete($task_id);
}