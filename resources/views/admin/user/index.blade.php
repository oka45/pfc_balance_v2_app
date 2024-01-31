<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ユーザー管理') }}
        </h2>
    </x-slot>
    <div class="container" style="color: white;">
        <table class="container text-center"> 
            <thead>
                <tr>
                    <th>名前</th>
                    <th>権限</th>
                    <th>メールアドレス</th>
                    <th>作成日</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <form action="{{ route('admin.user.delete', ['id' => $user->id  ]) }}" method="post" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <tr>
                            <td>{{ $user->name }}</td>
                            @if ($user->is_admin)
                                <td>管理者</td>
                            @else
                                <td>一般</td>
                            @endif
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            @if (Auth::user()->id === $user->id && Auth::user()->is_admin)
                            @else
                                <td><button type="submit" class="ms-3 bg-red-600 hover:bg-red-500 text-white rounded px-3 py-1" onclick='return confirm("本当に削除しますか？")'>削除</button></td>
                            @endif
                        </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
        <div class="text-white">
            {{ $users->links() }}
        </div>
    <div>
</x-app-layout>