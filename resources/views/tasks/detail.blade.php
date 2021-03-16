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
                        <label for="">
                            タスク名
                        </label>
                        <p>
                            {{ $post_data['task_info']['name'] }}
                        </p>
                    </div>
                    <div>
                        <label for="">
                            詳細
                        </label>
                        <p>
                            {{ $post_data['task_info']['task_detail']}}
                        </p>
                    </div>
                    <div>
                        <label for="">
                            期限
                        </label>
                        <p>
                            {{ $post_data['task_info']['limit_id'] }}
                        </p>
                    </div>
                    <div>
                        <label for="">
                            作成日
                        </label>
                        <p>
                            {{ $post_data['task_info']['created_at']}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>