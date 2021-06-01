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
                        <div>
                            <a href="{{ route('workspace.register') }}">
                                <button type="button" class="btn btn-primary">
                                    ワークスペースを登録
                                </button>
                            </a>
                        </div>
                        @foreach ($post_data['workspace_infos'] as $workspace_info)
                            <a href="{{ route('workspace.task.detail', ['workspace_id' => $workspace_info->id]) }}">
                                <div>
                                    <button type="button" class="btn btn-info">
                                        {{ $workspace_info->name }}
                                    </button>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>