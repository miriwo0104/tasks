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
                        <form action="{{ route('memo.update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">タイトル</label>
                                @error('name')
                                    {{ $message }}
                                @enderror
                                <input type="text" name="name" value="{{ $post_data['memo_info']['name'] }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">詳細</label>
                                @error('detail')
                                    {{ $message }}
                                @enderror
                                <textarea name="detail" class="form-control" id="exampleFormControlTextarea1" rows="10">{{ $post_data['memo_info']['detail'] }}</textarea>
                            </div>
                            <input type="hidden" name="memo_id" value="{{ $post_data['memo_info']['id'] }}">
                            <input type="hidden" name="workspace_id" value="{{ $post_data['workspace_id'] }}">
                            <button type="submit" class="btn btn-primary">登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>