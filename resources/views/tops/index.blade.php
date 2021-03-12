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
            @if (false)
                <div>
                    <div>
                        まだワークスペースを作成していません。最初にワークスペースを登録してみましょう！
                    </div>
                    <div>
                        <a href="{{ route('workspace.register') }}">
                            <button>
                                ワークスペースを登録
                            </button>
                        </a>
                    </div>
                </div>
                @else
                <div>                
                    <div>
                        <a href="{{ route('workspace.register') }}">
                            <button>
                                ワークスペースをさらに登録
                            </button>
                        </a>
                    </div>
                    @foreach ($post_data['workspace_info'] as $workspace_info)
                        <a href="{{ route('workspace.detail', ['workspace_id' => $workspace_info->id]) }}">
                            <button>
                                {{ $workspace_info->name }}
                            </button>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>