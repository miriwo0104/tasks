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
                    You're logged in!
                </div>
            </div>
            <div>
                <a href="{{ route('task.register', ['workspace_id' => $post_data['workspace_info']['id']]) }}">
                    <button>
                        TODOを登録
                    </button>
                </a>
                <div>
                    <h1>今日中</h1>
                    @if (!is_null($post_data['task_infos']['today_task_infos']))
                        <ol>
                            @foreach ($post_data['task_infos']['today_task_infos'] as $today_task_info)
                                <li type="disc">{{ $today_task_info['name'] }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p>タスクはありません</p>                    
                    @endif
                </div>
                <div>
                    <h1>明日中</h1>
                    @if (!is_null($post_data['task_infos']['tomorrow_task_infos']))
                        <ol>
                            @foreach ($post_data['task_infos']['tomorrow_task_infos'] as $tomorrow_task_info)
                            <li type="disc">{{ $tomorrow_task_info['name'] }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p>タスクはありません</p>                    
                    @endif
                </div>
                <div>
                    <h1>今週中</h1>
                    @if (!is_null($post_data['task_infos']['week_task_infos']))
                        <ol>
                            @foreach ($post_data['task_infos']['week_task_infos'] as $week_task_info)
                            <li type="disc">{{ $week_task_info['name'] }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p>タスクはありません</p>                    
                    @endif
                </div>
                <div>
                    <h1>今月中</h1>
                    @if (!is_null($post_data['task_infos']['month_task_infos']))
                        <ol>
                            @foreach ($post_data['task_infos']['month_task_infos'] as $month_task_info)
                            <li type="disc">{{ $month_task_info['name'] }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p>タスクはありません</p>                    
                    @endif
                </div>
                <div>
                    <h1>未定</h1>
                    @if (!is_null($post_data['task_infos']['undecided_task_infos']))
                        <ol>
                            @foreach ($post_data['task_infos']['undecided_task_infos'] as $undecide_task_info)
                                <li type="disc">{{ $undecide_task_info['name'] }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p>タスクはありません</p>                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>