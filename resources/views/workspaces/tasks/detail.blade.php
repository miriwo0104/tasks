<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post_data['page_name'] }}
        </h2>
    </x-slot>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('workspace.task.detail', ['workspace_id' => $post_data['workspace_info']['id']]) }}">Task</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('workspace.memo.detail', ['workspace_id' => $post_data['workspace_info']['id']]) }}">Memo</a>
        </li>
    </ul>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('task.register', ['workspace_id' => $post_data['workspace_info']['id']]) }}">
                        <button type="button" class="btn btn-primary btn-lg btn-block">
                            Taskを登録
                        </button>
                    </a>
                </div>
            </div>
            <div>
                <h1>今日中</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (!is_null($post_data['task_infos']['today_task_infos']))
                            <ol>
                                @foreach ($post_data['task_infos']['today_task_infos'] as $today_task_info)
                                    <div class="card" style="width: 100%">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $today_task_info['name'])) !!}</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('task.complete') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_info']['id'] }}">
                                                            <input type="hidden" name="task_id" value="{{ $today_task_info['id'] }}">
                                                            <button type="submit" type="button" class="btn btn-success card-link btn-lg btn-block">完了にする</button>
                                                        </form>
                                                    </div>
                                                    <div class="col">
                                                        <a href="{{ route('task.detail', ['workspace_id' => $post_data['workspace_info']['id'], 'task_id' => $today_task_info['id']]) }}">
                                                            <button type="button" class="btn btn-secondary card-link btn-lg btn-block">詳細</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ol>
                        @else
                            <p>タスクはありません</p>                    
                        @endif
                    </div>
                </div>
                <h1>明日中</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (!is_null($post_data['task_infos']['tomorrow_task_infos']))
                            <ol>
                                @foreach ($post_data['task_infos']['tomorrow_task_infos'] as $tomorrow_task_info)
                                    <div class="card" style="width: 100%">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $tomorrow_task_info['name'])) !!}</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('task.complete') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_info']['id'] }}">
                                                            <input type="hidden" name="task_id" value="{{ $tomorrow_task_info['id'] }}">
                                                            <button type="submit" type="button" class="btn btn-success card-link btn-lg btn-block">完了にする</button>
                                                        </form>
                                                    </div>
                                                    <div class="col">
                                                        <a href="{{ route('task.detail', ['workspace_id' => $post_data['workspace_info']['id'], 'task_id' => $tomorrow_task_info['id']]) }}">
                                                            <button type="button" class="btn btn-secondary card-link btn-lg btn-block">詳細</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ol>
                        @else
                            <p>タスクはありません</p>                    
                        @endif
                    </div>
                </div>
                <div>
                <h1>今週中</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (!is_null($post_data['task_infos']['week_task_infos']))
                            <ol>
                                @foreach ($post_data['task_infos']['week_task_infos'] as $week_task_info)
                                    <div class="card" style="width: 100%">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $week_task_info['name'])) !!}</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('task.complete') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_info']['id'] }}">
                                                            <input type="hidden" name="task_id" value="{{ $week_task_info['id'] }}">
                                                            <button type="submit" type="button" class="btn btn-success card-link btn-lg btn-block">完了にする</button>
                                                        </form>
                                                    </div>
                                                    <div class="col">
                                                        <a href="{{ route('task.detail', ['workspace_id' => $post_data['workspace_info']['id'], 'task_id' => $week_task_info['id']]) }}">
                                                            <button type="button" class="btn btn-secondary card-link btn-lg btn-block">詳細</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ol>
                        @else
                            <p>タスクはありません</p>                    
                        @endif
                    </div>
                </div>
                <h1>今月中</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (!is_null($post_data['task_infos']['month_task_infos']))
                            <ol>
                                @foreach ($post_data['task_infos']['month_task_infos'] as $month_task_info)
                                    <div class="card" style="width: 100%">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $month_task_info['name'])) !!}</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('task.complete') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_info']['id'] }}">
                                                            <input type="hidden" name="task_id" value="{{ $month_task_info['id'] }}">
                                                            <button type="submit" type="button" class="btn btn-success card-link btn-lg btn-block">完了にする</button>
                                                        </form>
                                                    </div>
                                                    <div class="col">
                                                        <a href="{{ route('task.detail', ['workspace_id' => $post_data['workspace_info']['id'], 'task_id' => $month_task_info['id']]) }}">
                                                            <button type="button" class="btn btn-secondary card-link btn-lg btn-block">詳細</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ol>
                        @else
                            <p>タスクはありません</p>                    
                        @endif
                    </div>
                </div>
                <h1>未定</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (!is_null($post_data['task_infos']['undecided_task_infos']))
                            <ol>
                                @foreach ($post_data['task_infos']['undecided_task_infos'] as $undecide_task_info)
                                    <div class="card" style="width: 100%">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $undecide_task_info['name'])) !!}</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('task.complete') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_info']['id'] }}">
                                                            <input type="hidden" name="task_id" value="{{ $undecide_task_info['id'] }}">
                                                            <button type="submit" type="button" class="btn btn-success card-link btn-lg btn-block">完了にする</button>
                                                        </form>
                                                    </div>
                                                    <div class="col">
                                                        <a href="{{ route('task.detail', ['workspace_id' => $post_data['workspace_info']['id'], 'task_id' => $undecide_task_info['id']]) }}">
                                                            <button type="button" class="btn btn-secondary card-link btn-lg btn-block">詳細</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ol>
                        @else
                            <p>タスクはありません</p>                    
                        @endif
                    </div>
                </div>
                <h1>完了</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (!is_null($post_data['task_infos']['complete_task_infos']))
                            <ol>
                                @foreach ($post_data['task_infos']['complete_task_infos'] as $complete_task_info)
                                    <li type="disc">{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $complete_task_info['name'])) !!}
                                        <form action="{{ route('task.incomplete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_info']['id'] }}">
                                            <input type="hidden" name="task_id" value="{{ $complete_task_info['id'] }}">
                                            <button type="submit" type="button" class="btn btn-warning">未完了にする</button>
                                        </form>
                                        <a href="{{ route('task.detail', ['workspace_id' => $post_data['workspace_info']['id'], 'task_id' => $complete_task_info['id']]) }}">
                                            <button type="button" class="btn btn-secondary">詳細</button>
                                        </a>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p>タスクはありません</p>
                        @endif
                    </div>
                </div>
                <h1>削除</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (!is_null($post_data['task_infos']['delete_task_infos']))
                            <ol>
                                @foreach ($post_data['task_infos']['delete_task_infos'] as $delete_task_info)
                                    <li type="disc">{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $delete_task_info['name'])) !!}
                                        <form action="{{ route('task.revive') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_info']['id'] }}">
                                            <input type="hidden" name="task_id" value="{{ $delete_task_info['id'] }}">
                                            <button type="submit" type="button" class="btn btn-warning">削除状態を取り消す</button>
                                        </form>
                                        <a href="{{ route('task.detail', ['workspace_id' => $post_data['workspace_info']['id'], 'task_id' => $delete_task_info['id']]) }}">
                                            <button type="button" class="btn btn-secondary">詳細</button>
                                        </a>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p>タスクはありません</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>