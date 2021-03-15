<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\TaskDetail;
use GuzzleHttp\Psr7\Request;

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
     * @param TaskDetail $TaskDetail
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
     * ワークスペースIDに紐付いた未完了タスクを返す
     *
     * @param int $workspace_id
     * @param int $limit_id
     * @return model Task
     */
    public function getTaskInfos($workspace_id, $limit_id)
    {
        return $this->Task
            ->where('workspace_id', $workspace_id)
            ->where('limit_id', $limit_id)
            ->where('statut_id', config('const.status.incomplete'))
            ->get();
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
        return $this->Task
            ->where('workspace_id', $workspace_id)
            ->where('statut_id', config('const.status.complete'))
            ->get();
    }

    /**
     * タスクを保存する
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

    /**
     * タスクのステータスを完了に変更する
     *
     * @param int $task_id
     * @return bool
     */
    public function changeComplete($task_id)
    {
        $task = $this->Task->find($task_id);
        $task->statut_id = config('const.status.complete');
        return $task->save();
    }

    /**
     * タスクのステータスを未完了に変更する
     *
     * @param int $task_id
     * @return bool
     */
    public function changeUncomplete($task_id)
    {
        $task = $this->Task->find($task_id);
        $task->statut_id = config('const.status.uncomplete');
        return $task->save();
    }
}