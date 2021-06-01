<?php

namespace App\Services;

use App\Repositories\MemoRepositoryInterface as MemoRepository;

class MemoService
{
    /**
     *
     * @var Memo
     */
    private $memoRepository;

    /**
     *
     * @param MemoRepository $memoRepository
     */
    public function __construct(MemoRepository $memoRepository)
    {
        $this->MemoRepository = $memoRepository;
    }

    /**
     * ワークスペースIDに紐付いた未完了メモを返す
     *
     * @param int $workspace_id
     * @return model Memo
     */
    public function getMemoInfos($workspace_id)
    {
        $memo_infos = $this->MemoRepository->getMemoInfos($workspace_id);
        return $this->nullCheck($memo_infos);
    }

    /**
     * 各メモのモデルを受け取り空のときnullを入れて返す
     *
     * @param model $memo_infos
     * @return model|null
     */
    public function nullCheck($memo_infos)
    {
        if ($memo_infos->isEmpty()) {
            return null;
        } else {
            return $memo_infos;
        }
    }

    /**
     * メモを保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function saveMemoInfo($post_data)
    {
        return $this->MemoRepository->saveMemoInfo($post_data);
    }

    /**
     * 編集されたメモの情報を保存する
     *
     * @param array $post_data
     * @return bool
     */
    public function updateMemoInfo($post_data)
    {
        return $this->MemoRepository->updateMemoInfo($post_data);
    }

    /**
     * メモの情報を返す
     *
     * @param int $memo_id
     * @return model
     */
    public function getMemoInfoByMemoId($memo_id)
    {
        return $this->MemoRepository->getMemoInfoByMemoId($memo_id);
    }

    /**
     * メモの削除
     *
     * @param int $memo_id
     * @return model
     */
    public function deleteMemoByMemoId($memo_id)
    {
        return $this->MemoRepository->deleteMemoByMemoId($memo_id);
    }

    /**
     * 削除状態メモの復帰
     *
     * @param int $memo_id
     * @return model
     */
    public function reviveDeletedMemoByMemoId($memo_id)
    {
        return $this->MemoRepository->reviveDeletedMemoByMemoId($memo_id);
    }

    /**
     * ワークスペースIDに紐付いた削除状態メモ情報を返す
     *
     * @param int $workspace_id
     * @return model Memo
     */
    public function getReviveDeletedMemoByMemoId($workspace_id)
    {
        return $this->MemoRepository->getReviveDeletedMemoByMemoId($workspace_id);
    }
}
