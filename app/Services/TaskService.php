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
     * Tasksの全ての内容を返す
     *
     * @param
     * @return model Task
     */
    public function getTaskInfos()
    {
        return $this->TaskRepository->getTaskInfos();
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
