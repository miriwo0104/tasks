<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post_data['page_name'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <h4>メモ名</h4>
                        <p>
                            {!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $post_data['memo_info']['name'])) !!}
                        </p>
                    </div>
                    <div>
                        <h4>詳細</h4>
                        <p>
                            {!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $post_data['memo_info']['detail'])) !!}
                        </p>
                    </div>
                    <div>
                        <h4>作成日</h4>
                        <p>
                            {{ $post_data['memo_info']['created_at'] }}
                        </p>
                    </div>
                    <div class="container">
                        <div class="row">
                            @if ($post_data['memo_info']['delete_flag'] === config('const.delete_flag.delete'))
                                <div class="col">
                                    <form action="{{ route('memo.revive') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_id'] }}">
                                        <input type="hidden" name="memo_id" value="{{ $post_data['memo_info']['id'] }}">
                                        <button type="submit" class="btn btn-warning btn-lg btn-block">削除状態を取り消す</button>
                                    </form>
                                </div>
                            @else
                                <div class="col">
                                    <a href="{{ route('memo.edit', ['workspace_id' => $post_data['workspace_id'], 'memo_id' => $post_data['memo_info']['id']]) }}">
                                        <button type="button" class="btn btn-secondary btn-lg btn-block">編集</button>
                                    </a>
                                </div>
                                <div class="col">
                                    <form action="{{ route('memo.delete') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_id'] }}">
                                        <input type="hidden" name="memo_id" value="{{ $post_data['memo_info']['id'] }}">
                                        <button type="submit" class="btn btn-danger btn-lg btn-block">削除</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <button type="button" onclick="history.back()" class="btn btn-dark btn-sm">←戻る</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>