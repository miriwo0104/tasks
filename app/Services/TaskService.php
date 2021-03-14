<?php

namespace App\Services;

use App\Repositories\TaskRepositoryInterface as TaskRepository;

class TaskService
{
    /**
     *
     * @var Task
     */
    private $TaskRepository;

    /**
     *
     * @param TaskRepository $TaskRepository
     */
    public function __construct(TaskRepository $TaskRepository)
    {
        $this->TaskRepository = $TaskRepository;
    }

    /**
     * ワークスペースIDに紐付いたタスクを返す
     *
     * @param int $workspace_id
     * @param int $limit_id
     * @return model Task
     */
    public function getTaskInfos($workspace_id, $limit_id)
    {
        $task_infos = $this->TaskRepository->getTaskInfos($workspace_id, $limit_id);
        return $this->nullCheck($task_infos);
    }

    /**
     * 各タスクのモデルを受け取り空のときnullを入れて返す
     *
     * @param model $task_infos
     * @return model|null
     */
    public function nullCheck($task_infos)
    {
        if ($task_infos->isEmpty()) {
            return null;
        } else {
            return $task_infos;
        }
    }

    /**
     * Taskを保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveTaskInfo($post_data)
    {
        return $this->TaskRepository->saveTaskInfo($post_data);
    }
}
