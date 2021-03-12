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
            <form action="{{ route('workspace.save') }}" method="post">
                @csrf
                <div>
                    ワークスペース名を入力
                </div>
                @error('workspace_name')
                    {{$message}}
                @enderror
                <input type="text" name="workspace_name" value="{{ old('workspace_name') }}">
                <input type="submit" value="保存">
            </form>
        </div>
    </div>
</x-app-layout>