<?php

namespace App\Repositories;

use App\Models\Memo;

class MemoRepository implements MemoRepositoryInterface
{
    /**
     *
     * @var Memo
     */
    private $memo;

    /**
     *
     * @param Memo $Memo
     */
    public function __construct(
        Memo $memo
    )
    {
        $this->Memo = $memo;
    }

    /**
     * ワークスペースIDに紐付いたメモ情報を返す
     *
     * @param int $workspace_id
     * @return model Memo
     */
    public function getMemoInfos($workspace_id)
    {
        return $this->Memo
            ->where('workspace_id', $workspace_id)
            ->where('delete_flag', config('const.delete_flag.not_delete'))
            ->get();
    }

    /**
     * メモを保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveMemoInfo($post_data)
    {
        $memo = $this->Memo;
        $memo->user_id = $post_data['user_id'];
        $memo->name = $post_data['name'];
        $memo->detail = $post_data['detail'];
        $memo->workspace_id = $post_data['workspace_id'];
        $memo->save();

        return true;
    }

    /**
     * 編集されたメモの情報を保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function updateMemoInfo($post_data)
    {
        $memo = $this->Memo->find($post_data['memo_id']);
        $memo->user_id = $post_data['user_id'];
        $memo->name = $post_data['name'];
        $memo->detail = $post_data['detail'];
        $memo->workspace_id = $post_data['workspace_id'];
        $memo->save();

        return true;
    }

    /**
     * メモの情報を返す
     *
     * @param int $memo_id
     * @return model
     */
    public function getMemoInfoByMemoId($memo_id)
    {
        return $this->Memo
            ->find($memo_id);
    }

    /**
     * メモの削除
     *
     * @param int $memo_id
     * @return model
     */
    public function deleteMemoByMemoId($memo_id)
    {
        $memo = $this->Memo->find($memo_id);
        $memo->delete_flag = config('const.delete_flag.delete');
        return $memo->save();
    }

    /**
     * 削除状態メモの復帰
     *
     * @param int $memo_id
     * @return model
     */
    public function reviveDeletedMemoByMemoId($memo_id)
    {
        $memo = $this->Memo->find($memo_id);
        $memo->delete_flag = config('const.delete_flag.not_delete');
        return $memo->save();
    }

    /**
     * ワークスペースIDに紐付いた削除状態メモ情報を返す
     *
     * @param int $workspace_id
     * @return model Memo
     */
    public function getReviveDeletedMemoByMemoId($workspace_id)
    {
        return $this->Memo
        ->where('workspace_id', $workspace_id)
        ->where('delete_flag', config('const.delete_flag.delete'))
        ->get();
    }
}