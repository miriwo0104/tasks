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
                <a href="">
                    <button>
                        TODOを登録
                    </button>
                </a>
                <div>
                    <h1>今日中</h1>
                </div>
                <div>
                    <h1>明日中</h1>
                </div>
                <div>
                    <h1>今週中</h1>
                </div>
                <div>
                    <h1>今月中</h1>
                </div>
                <div>
                    <h1>未定</h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>