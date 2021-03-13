<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\TaskDetail;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     *
     * @var Task
     */
    private $task;

    /**
     *
     * @var TaskDetail
     */
    private $task_detail;

    /**
     *
     * @param Task $Task
     */
    public function __construct(
        Task $task,
        TaskDetail $task_detail
    )
    {
        $this->Task = $task;
        $this->TaskDetail = $task_detail;
    }

    /**
     * Tasksの全ての内容を返す
     *
     * @param
     * @return model Task
     */
    public function getTaskInfos()
    {
        return $this->Task->get();
    }

    /**
     * Taskを保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveTaskInfo($post_data)
    {
        $task = $this->Task;
        $task->user_id = $post_data['user_id'];
        $task->name = $post_data['name'];
        $task->workspace_id = $post_data['workspace_id'];
        $task->limit_id = $post_data['limit_id'];
        $task->statut_id = config('const.status.incomplete');
        $task->save();

        if (!is_null($post_data['detail'])) {
            $task_detail = $this->TaskDetail;
            $task_detail->task_id = $task->id;
            $task_detail->detail = $post_data['detail'];
            $task_detail->save();
        }

        return true;
    }
}