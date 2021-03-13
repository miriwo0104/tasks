<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    /**
     * Tasksの全ての内容を返す
     *
     * @param
     * @return model Task
     */
    public function getTaskInfos();

    /**
     * Taskを保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveTaskInfo($post_data);
}