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
                        <h4>タスク名</h4>
                        <p>
                            {{ $post_data['task_info']['name'] }}
                        </p>
                    </div>
                    <div>
                        <h4>詳細</h4>
                        <p>
                            {!! nl2br(e($post_data['task_info']['detail'])) !!}
                        </p>
                    </div>
                    <div>
                        <h4>タイムリミット</h4>
                        <p>
                            {{ $post_data['task_info']['limits_name'] }}
                        </p>
                    </div>
                    <div>
                        <h4>作成日</h4>
                        <p>
                            {{ $post_data['task_info']['created_at'] }}
                        </p>
                    </div>
                    <div>
                        <form action="{{ route('task.complete') }}" method="post">
                            @csrf
                            <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_id'] }}">
                            <input type="hidden" name="task_id" value="{{ $post_data['task_info']['id'] }}">
                            <button type="submit" class="btn btn-success">完了にする</button>
                        </form>
                        <a href="{{ route('task.edit', ['workspace_id' => $post_data['workspace_id'], 'task_id' => $post_data['task_info']['id']]) }}">
                            <button type="button" class="btn btn-secondary">編集</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>