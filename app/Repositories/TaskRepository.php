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
     * 完了タスクを返す
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
        $task->detail = $post_data['detail'];
        $task->workspace_id = $post_data['workspace_id'];
        $task->limit_id = $post_data['limit_id'];
        $task->statut_id = config('const.status.incomplete');
        $task->save();

        return true;
    }

    /**
     * 編集されたタスクの情報を保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function updateTaskInfo($post_data)
    {
        $task = $this->Task->find($post_data['task_id']);
        $task->user_id = $post_data['user_id'];
        $task->name = $post_data['name'];
        $task->detail = $post_data['detail'];
        $task->workspace_id = $post_data['workspace_id'];
        $task->limit_id = $post_data['limit_id'];
        $task->statut_id = config('const.status.incomplete');
        $task->save();

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
    public function changeIncomplete($task_id)
    {
        $task = $this->Task->find($task_id);
        $task->statut_id = config('const.status.incomplete');
        return $task->save();
    }

    /**
     * タスクの情報を返す
     *
     * @param int $task_id
     * @return model
     */
    public function getTaskInfoByTaskId($task_id)
    {
        return $this->Task
            ->select('tasks.*', 'limits.name as limits_name')
            ->join('limits', 'tasks.limit_id', '=', 'limits.id')
            ->find($task_id);
    }

    /**
     * タスクの削除
     *
     * @param int $task_id
     * @return model
     */
    public function deleteTaskByTaskId($task_id)
    {
        return $this->Task->find($task_id)->delete();
    }
}