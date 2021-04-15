<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post_data['page_name'] }}
        </h2>
    </x-slot>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('workspace.task.detail', ['workspace_id' => $post_data['workspace_info']['id']]) }}">Task</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Memo</a>
        </li>
    </ul>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('memo.register', ['workspace_id' => $post_data['workspace_info']['id']]) }}">
                        <button type="button" class="btn btn-info btn-lg btn-block">
                            Memoを登録
                        </button>
                    </a>
                </div>
            </div>
            <div>
                <h1>メモ</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (!is_null($post_data['memo_infos']['memo_infos']))
                            <ol>
                                @foreach ($post_data['memo_infos']['memo_infos'] as $memo_info)
                                    <div class="card" style="width: 100%">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $memo_info['name'])) !!}</h5>
                                            <a href="{{ route('memo.detail', ['workspace_id' => $post_data['workspace_info']['id'], 'memo_id' => $memo_info['id']]) }}">
                                                <button type="button" class="btn btn-secondary card-link">詳細</button>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </ol>
                        @else
                            <p>メモはありません</p>                    
                        @endif
                    </div>
                </div>
                <h1>削除</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (!is_null($post_data['memo_infos']['delete_memo_infos']))
                            <ol>
                                @foreach ($post_data['memo_infos']['delete_memo_infos'] as $delete_memo_info)
                                    <li type="disc">{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $delete_memo_info['name'])) !!}
                                        <a href="{{ route('memo.detail', ['workspace_id' => $post_data['workspace_info']['id'], 'memo_id' => $delete_memo_info['id']]) }}">
                                            <button type="button" class="btn btn-secondary">詳細</button>
                                        </a>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p>メモはありません</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>