<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use App\Services\MemoService;
use App\Services\WorkspaceService;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    /**
     *
     * @var MemoService
     */
    public $memoService;

    /**
     *
     * @var Workspace
     */
    private $workspaceService;

    /**
     *
     * @param LimitService $limitService
     */
    public function __construct(
        MemoService $memoService,
        WorkspaceService $workspaceService
    )
    {
        $this->memoService = $memoService;
        $this->workspaceService = $workspaceService;
    }

    /**
     * メモの登録画面
     *
     * @param int $workspace_id
     * @return view
     */
    public function register($workspace_id)
    {
        $workspace_info = $this->workspaceService->getWorkspaceInfo($workspace_id);

        $post_data = [
            'page_name' => $workspace_info->name,
            'workspace_id' => $workspace_id,
        ];

        return view('memos.register', ['post_data' => $post_data]);
    }

    /**
     * メモの登録
     *
     * @param MemoRequest $post_data
     * @return redirect
     */
    public function save(MemoRequest $post_data)
    {
        $post_data['user_id'] = Auth::id();
        $this->memoService->saveMemoInfo($post_data);

        return redirect(route('workspace.memo.detail', ['workspace_id' => $post_data['workspace_id']]));
    }

    /**
     * メモの詳細
     *
     * @param int $memo_id
     * @return view
     */
    public function detail($workspace_id, $memo_id)
    {
        $workspace_info = $this->workspaceService->getWorkspaceInfo($workspace_id);

        $memo_info = $this->memoService->getMemoInfoByMemoId($memo_id);
        $post_data = [
            'page_name' => $workspace_info->name,
            'memo_info' => $memo_info,
            'workspace_id' => $workspace_id,
        ];

        return view('memos.detail', ['post_data' => $post_data]);
    }

    /**
     * メモ情報編集
     *
     * @param int $memo_id
     * @return view
     */
    public function edit($workspace_id, $memo_id)
    {
        $workspace_info = $this->workspaceService->getWorkspaceInfo($workspace_id);
        $memo_info = $this->memoService->getMemoInfoByMemoId($memo_id);

        $post_data = [
            'page_name' => $workspace_info->name,
            'memo_info' => $memo_info,
            'workspace_id' => $workspace_id,
        ];

        return view('memos.edit', ['post_data' => $post_data]);
    }

    /**
     * 編集したメモ情報を登録
     *
     * @param MemoRequest $post_data
     * @return redirect
     */
    public function update(MemoRequest $post_data)
    {
        $post_data['user_id'] = Auth::id();
        $this->memoService->updateMemoInfo($post_data);

        return redirect(route('workspace.memo.detail', ['workspace_id' => $post_data['workspace_id']]));
    }

    /**
     * メモの削除
     *
     * @param int $memo_id
     * @return redirect
     */
    public function delete(Request $post_data)
    {
        $this->memoService->deleteMemoByMemoId($post_data['memo_id']);

        return redirect(route('workspace.memo.detail', ['workspace_id' => $post_data['workspace_id']]));
    }

    /**
     * 削除状態メモの復帰
     *
     * @param int $memo_id
     * @return redirect
     */
    public function revive(Request $post_data)
    {
        $this->memoService->reviveDeletedMemoByMemoId($post_data['memo_id']);

        return redirect(route('workspace.memo.detail', ['workspace_id' => $post_data['workspace_id']]));
    }
}
