<?php

namespace App\Repositories;

interface MemoRepositoryInterface
{
    /**
     * ワークスペースIDに紐付いた未完了メモを返す
     *
     * @param int $workspace_id
     * @param int $limit_id
     * @return model Memo
     */
    public function getMemoInfos($workspace_id);

    /**
     * メモを保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveMemoInfo($post_data);

    /**
     * 編集されたメモの情報を保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function updateMemoInfo($post_data);

    /**
     * メモの情報を返す
     *
     * @param int $memo_id
     * @return model
     */
    public function getMemoInfoByMemoId($memo_id);

    /**
     * メモの削除
     *
     * @param int $memo_id
     * @return model
     */
    public function deleteMemoByMemoId($memo_id);

    /**
     * 削除状態メモの復帰
     *
     * @param int $memo_id
     * @return model
     */
    public function reviveDeletedMemoByMemoId($workspace_id);

    /**
     * ワークスペースIDに紐付いた削除状態メモ情報をMemo
     * @param int $workspace_id
     * @return model Memo
     */
    public function getReviveDeletedMemoByMemoId($workspace_id);
}