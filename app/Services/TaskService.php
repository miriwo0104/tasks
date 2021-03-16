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
     * ワークスペースIDに紐付いた未完了タスクを返す
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
     * ワークスペースIDに紐付いた完了タスクを返す
     *
     * @param int $workspace_id
     * @param int $limit_id
     * @return model Task
     */
    public function getCompleteTaskInfos($workspace_id)
    {
        $task_infos = $this->TaskRepository->getCompleteTaskInfos($workspace_id);
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
     * タスクを保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveTaskInfo($post_data)
    {
        return $this->TaskRepository->saveTaskInfo($post_data);
    }

    /**
     * タスクのステータスを完了に変更する
     *
     * @param int $task_id
     * @return void
     */
    public function changeComplete($task_id)
    {
        return $this->TaskRepository->changeComplete($task_id);
    }

    /**
     * タスクのステータスを未完了に変更する
     *
     * @param int $task_id
     * @return void
     */
    public function changeIncomplete($task_id)
    {
        return $this->TaskRepository->changeIncomplete($task_id);
    }

    /**
     * タスクの情報を返す
     *
     * @param int $task_id
     * @return model
     */
    public function getTaskInfoByTaskId($task_id)
    {
        return $this->TaskRepository->getTaskInfoByTaskId($task_id);
    }
}
